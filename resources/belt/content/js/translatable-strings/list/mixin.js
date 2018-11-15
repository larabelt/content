import store from 'belt/content/js/translatable-strings/list/store';

export default {
    created() {
        if (!this.$store.state['translatableStrings']) {
            this.$store.registerModule('translatableStrings', store);
        }
    },
    computed: {
        translatableStrings() {
            return this.$store.getters['translatableStrings/data'];
        },
    },
}