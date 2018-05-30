import Form from 'belt/content/js/blocks/form';
import store from 'belt/content/js/blocks/store';

export default {
    created() {
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.block_id});
        }
    },
    computed: {
        config() {
            return this.$store.getters[this.storeKey + '/config/data'];
        },
        block() {
            return this.$store.getters[this.storeKey + '/form'];
        },
        storeKey() {
            return 'blocks' + this.block_id;
        },
    },
    methods: {

    },
    data() {
        return {
            block_id: null,
        }
    },
}