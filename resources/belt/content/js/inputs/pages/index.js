import shared from 'belt/core/js/inputs/shared';
import PageTable from 'belt/content/js/pages/table';
import PageForm from 'belt/content/js/pages/form';
import html from 'belt/content/js/inputs/pages/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            page: new PageForm(),
            pages: new PageTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'Page');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find pages that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            this.page.show(newValue);
        });
    },
    mounted() {
        if (this.value) {
            this.page.show(this.value);
        }
    },
    methods: {
        clear() {
            this.pages.query.q = '';
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