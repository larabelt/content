// helpers
import Form from 'belt/content/js/posts/form';

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
    computed: {
        config() {
            return this.form.config;
        },
        sectionable() {
            return _.get(this.config, 'sectionable', false);
        },
    },
    components: {
        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.entity_id);
    },
    template: edit_html,
}