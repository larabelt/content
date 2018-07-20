import base from 'belt/core/js/inputs/filter-base';
import shared from 'belt/content/js/subtypes/shared';
import html from 'belt/content/js/subtypes/filters/default/template.html';

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
            subtype: null,
        }
    },
    watch: {
        'table.query.subtype': function (subtype) {
            if (subtype) {
                this.subtype = subtype;
            }
        }
    },
    methods: {
        change() {
            this.table.query.subtype = this.subtype;
            this.$emit('filter-subtype-update');
        },
    },
    template: html
}