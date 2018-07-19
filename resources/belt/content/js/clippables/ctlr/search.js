import thumb from 'belt/content/js/attachments/thumb';

// helpers
import Form from 'belt/content/js/clippables/form';

// templates
import search_html from 'belt/content/js/clippables/templates/search.html';

export default {
    data() {
        return {
            detached: this.$parent.detached,
            table: this.$parent.table,
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
        }
    },
    components: {thumb},
    methods: {
        attach(id) {
            this.form.setData({id: id});
            this.form.store()
                .then(() => {
                    this.table.index();
                    this.detached.index();
                    Events.$emit('clippable-attach', id);
                })
        },
        clear() {
            this.detached.query.q = '';
        },
    },
    template: search_html
}