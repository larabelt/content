import shared from 'belt/content/js/sectionables/shared';
import store from 'belt/content/js/sectionables/store';
import Form from 'belt/content/js/sectionables/form';
import params from 'belt/core/js/paramables/ctlr/index';
import html from 'belt/content/js/sectionables/edit/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            loading: false,
            section: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    computed: {
        config() {
            return this.$store.getters[this.storeKey + '/config/data'];
        },
        storeKey() {
            return 'sections' + this.section.id;
        },
        templateGroups() {
            let options = [];
            let templates = this.configs ? this.configs : {};
            _.forOwn(templates, function (template, key) {
                options.push({
                    key: key,
                    label: template.label ? template.label : key,
                });
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
        templates() {
            let options = [];
            let templates = _.get(this.configs, this.section.template_subgroup, {});
            _.forOwn(templates, (template, key) => {
                template.key = this.section.template_subgroup + '.' + key;
                template.label = template.label ? template.label : key;
                options.push(template);
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
            });
    },
    components: {params},
    methods: {
        updateSection() {
            this.loading = true;
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
    template: html,
}