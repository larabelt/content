import block from 'belt/content/js/blocks/store/mixin';
import tabs_html from 'belt/content/js/blocks/edit/tabs.html';
import html from 'belt/content/js/blocks/edit/template.html';

export default {
    mixins: [block],
    data() {
        return {
            entity_type: 'blocks',
            entity_id: this.$route.params.id,
            block_id: this.$route.params.id,
        }
    },
    mounted() {
        this.$store.dispatch(this.storeKey + '/load', this.block_id);
    },
    computed: {
        config() {
            return this.$store.getters[this.storeKey + '/config/data'];
        },
        form() {
            return this.block;
        },
        storeKey() {
            return 'blocks' + this.entity_id;
        },
    },
    components: {
        tabs: {template: tabs_html},
        edit: {},
    },
    template: html,
}