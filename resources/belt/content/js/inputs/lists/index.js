import shared from 'belt/core/js/inputs/shared';
import ListTable from 'belt/content/js/lists/table';
import ListForm from 'belt/content/js/lists/form';
import html from 'belt/content/js/inputs/lists/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            list: new ListForm(),
            lists: new ListTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'List');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find lists that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            if(newValue) {
                this.list.show(newValue);
            }
        });
    },
    mounted() {
        if (this.value) {
            this.list.show(this.value);
        }
    },
    methods: {
        clear() {
            this.lists.query.q = '';
        },
        unlink() {
            this.form[this.column] = null;
            this.list.reset();
        },
        update(id) {
            this.form[this.column] = id;
            this.clear();
            this.emitEvent();
        },
    },
    components: {},
    template: html
}