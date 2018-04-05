import shared from 'belt/content/js/sectionables/shared';
import html from 'belt/content/js/sectionables/templates/template.html';

export default {
    mixins: [shared],
    computed: {
        subgroup() {
            return this.$parent.templateSubgroup;
        },
        templates() {
            let options = [];
            let templates = _.get(this.configs, this.subgroup, {});
            _.forOwn(templates, (template, key) => {
                template.name = this.subgroup + '.' + key;
                template.label = template.label ? template.label : key;
                options.push(template);
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
    },
    methods: {
        update(template) {
            this.$emit('select-section-template', template);
        },
    },
    template: html,
}