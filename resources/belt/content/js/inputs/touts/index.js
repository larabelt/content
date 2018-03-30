import shared from 'belt/core/js/inputs/shared';
import ToutTable from 'belt/content/js/touts/table';
import ToutForm from 'belt/content/js/touts/form';
import html from 'belt/content/js/inputs/tout/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            tout: new ToutForm(),
            touts: new ToutTable({query: {perPage: 20}}),
        };
    },
    created() {
        this.config.label = _.get(this.config, 'label', 'Tout');
        this.config.description = _.get(this.config, 'description', 'Use the search field to find touts that can be linked to this item.');
        this.$watch('form.' + this.column, function (newValue) {
            this.tout.show(newValue);
        });
    },
    mounted() {
        if (this.value) {
            this.tout.show(this.value);
        }
    },
    methods: {
        clear() {
            this.touts.query.q = '';
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