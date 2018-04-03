import shared from 'belt/content/js/sectionables/shared';
import html from 'belt/content/js/sectionables/templates/groups/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            group: false,
        }
    },
    computed: {
        groups() {
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
        subgroup() {
            return this.$parent.templateSubgroup;
        }
    },
    methods: {
        update() {
            this.$emit('select-section-template-group', this.group);
        },
    },
    template: html,
}