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
        templates() {
            let configs = this.$store.getters['configs/data'];
            let group = _.get(configs, 'sections.' + this.active.template_subgroup);
            let templates = [];
            for (let key in group) {
                let config = group[key];
                let template = {
                    key: this.active.template_subgroup + '.' + key,
                    label: config['label'] ? config['label'] : key
                };
                templates.push(template);
            }
            return _.sortBy(templates, [function (o) {
                return o.key;
            }]);
        }
    },
    template: html,
}