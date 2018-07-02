import Form from 'belt/content/js/lists/edit/items/form';
import html from 'belt/content/js/lists/edit/items/grid-item/template.html';

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
            if (this.item.id == this.moving_id) {
                return 'is-moving';
            }
            if (this.moving_id) {
                return 'is-watching';
            }
            return 'default';
        },
        moving_id() {
            return this.$parent.moving_id;
        },
        tile() {
            return 'tile-default';
            // let tileName = 'tile-' + this.item.listable_type;
            // return _.has(Vue.options.components, tileName) ? tileName : 'tile-default';
        },
        type() {
            return this.item.listable_type;
        },
    },
    mounted() {

    },
    methods: {
        cancelMove() {
            this.$emit('cancel-listable-move');
        },
        highlight(id) {
            this.$emit('highlight-listable', id);
        },
        move(target_id, position) {

            let form = new Form({morphable_id: this.item.list_id});
            form.id = this.moving_id;
            form.move = position;
            form.position_entity_id = target_id;

            form.submit()
                .then(() => {
                    this.$emit('complete-listable-move');
                });
        },
        startMove(id) {
            this.$emit('start-listable-move', id);
        },
    },
    template: html,
}