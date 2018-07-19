// helpers
import Form from 'belt/content/js/terms/form';

// templates make a change

import tabs_html from 'belt/content/js/terms/templates/tabs.html';
import edit_html from 'belt/content/js/terms/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            parentTerm: new Form(),
            entity_type: 'terms',
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
        this.form.show(this.entity_id)
            .then(() => {
                if (this.form.parent_id) {
                    this.parentTerm.show(this.form.parent_id);
                }
            });
    },
    template: edit_html,
}