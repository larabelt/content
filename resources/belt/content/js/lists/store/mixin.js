import Form from 'belt/content/js/lists/form';
import store from 'belt/content/js/lists/store';

export default {
    created() {
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.list_id});
        }
    },
    computed: {
        config() {
            return this.$store.getters[this.storeKey + '/config/data'];
        },
        list() {
            return this.$store.getters[this.storeKey + '/form'];
        },
        storeKey() {
            return 'lists' + this.list_id;
        },
    },
    methods: {

    },
    data() {
        return {
            list_id: null,
        }
    },
}