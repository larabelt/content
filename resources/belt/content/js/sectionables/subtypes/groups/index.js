import shared from 'belt/content/js/sectionables/shared';
import html from 'belt/content/js/sectionables/subtypes/groups/template.html';

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
            let subtypes = this.configs ? this.configs : {};
            _.forOwn(subtypes, function (subtype, key) {
                options.push({
                    value: key,
                    label: subtype.label ? subtype.label : key,
                });
            });
            options = _.orderBy(options, ['label']);
            return options;
        },
        subgroup() {
            return this.$parent.subtypeSubgroup;
        }
    },
    methods: {
        update(group) {
            //group = group ? group : this.group;
            this.group = group;
            this.$emit('select-section-subtype-group', group);
        },
    },
    template: html,
}