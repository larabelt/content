// helpers
import Form from 'belt/content/js/posts/form';
import store from 'belt/content/js/posts/store';

// templates make a change
import tabs_html from 'belt/content/js/posts/templates/tabs.html';
import edit_html from 'belt/content/js/posts/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            entity_type: 'posts',
            entity_id: this.$route.params.id,
        }
    },
    created() {
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.entity_id});
        }
        this.form.show(this.entity_id)
            .then(() => {
                this.$store.dispatch(this.storeKey + '/load', this.form);
            });
    },
    computed: {
        config() {
            return this.form.config;
        },
        sectionable() {
            return _.get(this.config, 'sectionable', false);
        },
        storeKey() {
            return 'posts' + this.entity_id
        }
    },
    components: {
        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.entity_id);
    },
    template: edit_html,
}