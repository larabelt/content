import clippable from 'belt/content/js/clippables/store/clippable';
import highlighted from 'belt/content/js/clippables/store/highlighted';

export default {
    beforeCreate() {
        if (!this.$store.state['clippable']) {
            this.$store.registerModule('clippable', clippable);
        }
        if (!this.$store.state['highlighted']) {
            this.$store.registerModule('highlighted', highlighted);
        }
    },
    computed: {
        active() {
            return this.$store.getters['clippable/active'];
        },
        attachments() {
            return this.table.items;
        },
        hasattachments() {
            return this.table.items.length;
        },
        hasHighlighted() {
            let highlighted = this.$store.getters['highlighted/data'];
            return !_.isEmpty(highlighted);
        },
        mode() {
            return this.$store.getters['clippable/mode'];
        },
        entity_id() {
            return this.$store.getters['clippable/entity_id'];
        },
        entity_type() {
            return this.$store.getters['clippable/entity_type'];
        },
        table() {
            return this.$store.getters['clippable/table'];
        },
    },
    methods: {
        attach(payload) {
            this.$store.dispatch('clippable/attach', payload)
                .then(() => {
                    this.$store.dispatch('clippable/load');
                    this.$store.dispatch('uploading/search_attachments/load');
                });
        },
        detachHighlighted() {
            let highlighted = this.$store.getters['highlighted/data'];
            for (let id in highlighted) {
                this.$store.dispatch('clippable/detach', id)
                    .then(() => {
                        this.$store.dispatch('clippable/load');
                        this.$store.dispatch('highlighted/forget', id);
                    });
            }
        },
        setEdit(attachment) {
            this.$store.dispatch('clippable/active', attachment);
            this.$store.dispatch('clippable/set', {mode: 'edit'});
            this.$router.push({name: 'clippables.edit', params: {attachment_id: attachment.id}});
        },
    },
};