import Form from 'belt/content/js/termables/form';
import Table from 'belt/content/js/termables/table';
import html from 'belt/content/js/termables/templates/index.html';

export default {
    data() {
        return {
            detached: new Table({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
                query: {not: 1},
            }),
            table: new Table({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            search: false,
        }
    },
    mounted() {
        this.table.index();
    },
    methods: {
        attach(id) {
            this.form.setData({id: id});
            this.form.store()
                .then(response => {
                    this.table.index();
                    this.detached.index();
                })
        },
        browse() {
            this.search = !this.search;
            if (this.search && !this.detached.items.length) {
                this.detached.index();
            }
        },
        clear() {
            this.search = false;
            this.detached.query.q = '';
            this.detached.empty();
        },
        filter: _.debounce(function (query) {
            this.search = true;
            if (query) {
                query.page = 1;
                this.detached.updateQuery(query);
            }
            this.detached.index()
                .then(() => {

                });
        }, 250),
    },
    template: html
}