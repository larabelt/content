import list from 'belt/content/js/lists/store/mixin';
import tabs_html from 'belt/content/js/lists/edit/tabs.html';
import html from 'belt/content/js/lists/edit/template.html';

export default {
    mixins: [list],
    data() {
        return {
            morphable_type: 'lists',
            morphable_id: this.$route.params.id,
            list_id: this.$route.params.id,
        }
    },
    mounted() {
        this.$store.dispatch(this.storeKey + '/load', this.list_id);
    },
    computed: {
        config() {
            return this.form.config;
            //return this.$store.getters[this.storeKey + '/config/data'];
        },
        form() {
            return this.list;
        },
        sectionable() {
            return _.get(this.config, 'sectionable', false);
        },
        storeKey() {
            return 'lists' + this.morphable_id;
        },
    },
    components: {
        tabs: {template: tabs_html},
        edit: {},
    },
    template: html,
}