import list from 'belt/content/js/lists/list';
import Form from 'belt/content/js/lists/form';
import Table from 'belt/content/js/lists/table';
import html from 'belt/content/js/lists/input/template.html';

export default {
    props: ['form'],
    data() {
        return {
            list: new Form(),
            search: false,
            table: new Table(),
        }
    },
    watch: {
        'form.list_id': function (new_list_id) {
            if (new_list_id) {
                this.list.show(new_list_id);
            }
        }
    },
    methods: {
        filter: _.debounce(function (query) {
            this.table.index();
        }, 500),
        toggle() {
            if (!this.search) {
                this.table.index();
            }
            this.search = !this.search;
        },
        clear() {
            this.form.list_id = null;
            this.list.reset();
            this.search = false;
        },
        setList(list) {
            this.form.list_id = list.id;
            this.list.setData(list);
            this.search = false;
        }
    },
    components: {
        list
    },
    template: html
}