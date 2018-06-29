import Form from 'belt/content/js/lists/edit/related/form';
import html from 'belt/content/js/lists/edit/related/row-item/template.html';

export default {
    props: {
        'item': {
            default: null,
        }
    },
    data() {
        return {

        }
    },
    computed: {
        highlighted() {
            return _.has(this.$parent.highlighted, this.item.id);
        },
        list_id() {
            return this.$parent.morphable_id;
        },
        mode() {
            return 'default';
        },
        tile() {
            let tileName = 'tile-' + this.item.listable_type;
            return _.has(Vue.options.components, tileName) ? tileName : 'tile-default';
        },
        type() {
            return this.item.listable_type;
        },
    },
    mounted() {

    },
    methods: {
        highlight(id) {
            this.$emit('highlight-listable', id);
        },
    },
    template: html,
}