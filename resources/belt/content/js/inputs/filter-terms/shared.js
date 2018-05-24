import base from 'belt/core/js/inputs/filter-base';
import store from 'belt/content/js/inputs/filter-terms/store';

export default {
    mixins: [base],
    props: {
        _query: {
            default: null,
        },
    },
    computed: {
        attached() {
            return this.$store.getters['filterTerms/attached'];
        },
        detached() {
            return this.$store.getters['filterTerms/detached'];
        },
        hasAttached() {
            return this.$store.getters['filterTerms/hasAttached'];
        },
        hasDetached() {
            return this.$store.getters['filterTerms/hasDetached'];
        },
        needle() {
            return this.$store.getters['filterTerms/needle'];
        },
        query() {
            return this.$store.getters['filterTerms/query'];
        },
    },
    beforeCreate() {
        if (!this.$store.state.filterTerms) {
            this.$store.registerModule('filterTerms', store);
        }
    },
    created() {
        if (this._query) {
            this.$store.dispatch('filterTerms/queryToAttached', this._query);
        }
    },
    mounted() {
        this.$store.dispatch('filterTerms/morphableType', this.morphable_type);
    },
    methods: {
        emptyDetached() {
            this.$store.dispatch('filterTerms/emptyDetached');
        },
        push(term) {
            this.$store.dispatch('filterTerms/push', term);
            this.$emit('filter-terms-update', {term: this.query});
        },
        remove(term) {
            this.$store.dispatch('filterTerms/remove', term);
            this.$emit('filter-terms-update', {term: this.query});
        },
        filter: _.debounce(function (e) {
            let needle = e.target.value;
            if (needle) {
                this.$store.dispatch('filterTerms/needle', needle);
                this.$store.dispatch('filterTerms/search');
            } else {
                this.emptyDetached();
            }
        }, 250),
    },
}