import shared from 'belt/content/js/sectionables/shared';
import store from 'belt/content/js/sectionables/store';
import Form from 'belt/content/js/sectionables/form';
import subtypes from 'belt/content/js/sectionables/subtypes';
import html from 'belt/content/js/sectionables/edit/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            loading: false,
            section: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            section_id: this.$route.params.section_id,
            showSubtypes: false,
        }
    },
    computed: {
        config() {
            return this.$store.getters[this.storeKey + '/config/data'];
        },
        storeKey() {
            return 'sections' + this.section.id;
        },
        subtypeSubgroup() {
            return this.section.subtype_subgroup;
        },
        subtypeGroups() {
            let options = [];
            let subtypes = this.configs ? this.configs : {};
            _.forOwn(subtypes, function (subtype, key) {
                options.push({
                    key: key,
                    label: subtype.label ? subtype.label : key,
                });
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
        subtypes() {
            let options = [];
            let subtypes = _.get(this.configs, this.section.subtype_subgroup, {});
            _.forOwn(subtypes, (subtype, key) => {
                subtype.key = this.section.subtype_subgroup + '.' + key;
                subtype.label = subtype.label ? subtype.label : key;
                options.push(subtype);
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
    },
    created() {
        let section_id = this.section.id = this.$route.params.section_id;

        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.section.id});
        }

        this.section.show(section_id)
            .then(() => {
                this.$store.dispatch(this.storeKey + '/load', this.section);
                this.$store.dispatch(this.storeKey + '/params/load');
                console.log(this.section);
            });
    },

    methods: {
        submit() {
            Events.$emit('sections:' + this.section_id + ':updating', this.section);
        },
        update(subtype) {
            this.showSubtypes = false;
            this.loading = true;
            this.section.subtype = subtype;
            this.section.submit()
                .then(() => {
                    this.$store.dispatch(this.storeKey + '/load', this.section);
                    this.$store.dispatch(this.storeKey + '/params/load')
                        .then(() => {
                            this.loading = false;
                        });
                });
        }
    },
    components: {
        subtypes,
    },
    template: html,
}