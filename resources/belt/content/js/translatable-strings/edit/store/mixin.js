import store from 'belt/content/js/translatable-strings/edit/store';

export default {
    beforeCreate() {
        this.$store.dispatch('abilities/construct');
    },
    data() {
        return {
            translatableString_id: null,
        }
    },
    created() {
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/load', this.translatableString_id);
        }
    },
    computed: {
        storeKey() {
            if (this.translatableString_id) {
                return 'translatableStrings' + this.translatableString_id;
            }
        },
        translatableString() {
            return this.$store.getters[this.storeKey + '/form'];
        },
        permissions() {
            return this.$store.getters[this.storeKey + '/permissions/data'];
        },
    },
}