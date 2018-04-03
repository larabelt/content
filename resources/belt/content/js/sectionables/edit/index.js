import shared from 'belt/content/js/sectionables/shared';
import store from 'belt/content/js/sectionables/store';
import Form from 'belt/content/js/sectionables/form';
import params from 'belt/core/js/paramables/ctlr/index';
import html from 'belt/content/js/sectionables/edit/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            active: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    computed: {
        config() {
            return this.$store.getters[this.storeActiveKey + '/config/data'];
        },
        storeActiveKey() {
            return 'sections' + this.active.id;
        },
        templateGroups() {

            let options = [];
            let templates = this.configs ? this.configs : {};

            _.forOwn(templates, function (template, key) {
                options.push({
                    value: key,
                    label: template.label ? template.label : key,
                });
            });

            options = _.orderBy(options, ['label']);

            return options;
        },
        templates() {

            let options = [];
            let templates = _.get(this.configs, this.activeGroup, {});

            _.forOwn(templates, (template, key) => {
                template.name = this.activeGroup + '.' + key;
                template.label = template.label ? template.label : key;
                options.push(template);
            });

            options = _.orderBy(options, ['label']);

            return options;
        },
    },
    created() {
        let section_id = this.$route.params.section_id;
        this.active.id = section_id;

        if (!this.$store.state[this.storeActiveKey]) {
            this.$store.registerModule(this.storeActiveKey, store);
            this.$store.dispatch(this.storeActiveKey + '/construct', {id: this.active.id});
        }
        this.$store.dispatch(this.storeActiveKey + '/load', this.active);
        this.$store.dispatch(this.storeActiveKey + '/params/load');

        this.active.show(section_id);
    },
    components: {params},
    methods: {
        save: _.debounce(function () {
            this.active.submit()
                .then(() => {
                    this.sections.index();
                });
        }, 1000),
    },
    template: html,
}