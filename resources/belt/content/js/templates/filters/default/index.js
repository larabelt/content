import base from 'belt/core/js/inputs/filter-base';
import shared from 'belt/content/js/templates/shared';
import html from 'belt/content/js/templates/filters/default/template.html';

export default {
    mixins: [base, shared],
    props: {
        table: {
            default: function () {
                return this.$parent.table;
            }
        },
    },
    data() {
        return {
            template: null,
        }
    },
    watch: {
        'table.query.template': function (template) {
            if (template) {
                this.template = template;
            }
        }
    },
    methods: {
        change() {
            console.log(111);
            this.table.query.template = this.template;
            this.$emit('filter-template-update');
        },
    },
    template: html
}