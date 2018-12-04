import store from 'belt/content/js/handleables/store';
import Form from 'belt/content/js/handleables/form';
import Table from 'belt/content/js/handleables/table';

export default {
    created() {
        if (!this.$store.state[this.handleableStoreKey]) {
            this.$store.registerModule(this.handleableStoreKey, store);
            this.loadHandles();
        }
    },
    data() {
        return {
            table: new Table(),
        }
    },
    mounted() {
        this.table = new Table({entity_type: this.handleableType, entity_id: this.handleableID});
    },
    watch: {
        'handleable.id': function () {
            this.loadHandles();
        }
    },
    computed: {
        handleable() {
            return this.form;
        },
        handleableID() {
            return this.entity_id;
        },
        handleableStoreKey() {
            return 'handles/' + this.handleableType + this.handleableID;
        },
        handleableType() {
            return this.entity_type;
        },
        handles() {
            return this.$store.getters[this.handleableStoreKey + '/handles'];
        },
    },
    methods: {
        dropHandle(handle) {
            let id = handle.id;
            let keep = this.handles;
            _.remove(keep, function (handle) {
                return handle.id == id;
            });
            this.$store.dispatch(this.handleableStoreKey + '/setHandles', []);
            this.$store.dispatch(this.handleableStoreKey + '/setHandles', keep);
        },
        loadHandles() {
            let handles = _.get(this.handleable, 'handles', []);
            if (handles.length) {
                this.pushHandles(handles);
            } else {
                this.fetchHandles();
            }
        },
        fetchHandles() {
            this.$store.dispatch(this.handleableStoreKey + '/setHandles', []);
            this.table.index()
                .then((response) => {
                    this.pushHandles(response.data);
                });
        },
        pushHandles(handles) {
            _.each(handles, (handle) => {
                let form = new Form({entity_type: this.handleableType, entity_id: this.handleableID});
                form.mergeData(handle);
                this.$store.dispatch(this.handleableStoreKey + '/pushHandle', form);
            });
        },
    }
}