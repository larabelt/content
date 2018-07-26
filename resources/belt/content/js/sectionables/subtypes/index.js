import shared from 'belt/content/js/sectionables/shared';
import html from 'belt/content/js/sectionables/subtypes/template.html';

export default {
    mixins: [shared],
    computed: {
        subgroup() {
            return this.$parent.subtypeSubgroup;
        },
        subtypes() {
            let options = [];
            let subtypes = _.get(this.configs, this.subgroup, {});
            _.forOwn(subtypes, (subtype, key) => {
                subtype.name = this.subgroup + '.' + key;
                subtype.label = subtype.label ? subtype.label : key;
                options.push(subtype);
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
    },
    methods: {
        update(subtype) {
            this.$emit('select-section-subtype', subtype);
        },
    },
    template: html,
}