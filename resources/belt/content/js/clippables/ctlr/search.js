import thumb from 'belt/content/js/attachments/thumb';

// helpers
import Form from 'belt/content/js/clippables/form';

// templates
import search_html from 'belt/content/js/clippables/templates/search.html';

export default {
    data() {
        return {
            detached: this.$parent.detached,
            loading: false,
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            showResults: false,
            table: this.$parent.table,
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
            this.showResults = false;
            this.detached.query.q = '';
        },
        filter: _.debounce(function () {
            this.loading = true;
            this.detached.index()
                .then(() => {
                    this.showResults = true;
                    this.loading = false;
                });
        }, 300),
    },
    template: search_html
}