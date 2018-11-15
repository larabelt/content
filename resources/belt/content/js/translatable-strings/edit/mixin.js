import Form from 'belt/content/js/translatable-strings/form';
import tabs_html from 'belt/content/js/translatable-strings/edit/tabs.html';
import html from 'belt/content/js/translatable-strings/edit/template.html';

export default {
    data() {
        return {
            form: new Form(),
            entity_type: 'translatable_strings',
            entity_id: this.$route.params.id,
            translatable_string_id: this.$route.params.id,
        }
    },
    mounted() {
        this.form.show(this.entity_id)
            .then(() => {
                _.set(this.form, 'config.translatable', ['value']);
            });
    },
    components: {
        tabs: {template: tabs_html},
    },
    template: html,
}