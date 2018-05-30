import Form from 'belt/content/js/lists/edit/related/form';
import html from 'belt/content/js/lists/edit/related/row-item/template.html';

export default {
    props: {
        'item': {
            default: null,
        }
    },
    computed: {
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
        name() {
            return _.get(this.item, 'listable.name');
        },
        type() {
            return this.item.listable_type;
        },
    },
    methods: {
        cancelMove() {
            this.$emit('cancel-listable-move');
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