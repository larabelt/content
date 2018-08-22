import shared from 'belt/core/js/inputs/shared';
import TermTable from 'belt/content/js/terms/table';
import TermForm from 'belt/content/js/terms/form';
import html from 'belt/content/js/inputs/terms/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            term: new TermForm(),
            terms: new TermTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'Term');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find terms that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            this.term.show(newValue);
        });
    },
    mounted() {
        if (this.value) {
            this.term.show(this.value);
        }
    },
    methods: {
        clear() {
            this.terms.query.q = '';
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