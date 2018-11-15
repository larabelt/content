import tabs_html from 'belt/content/js/translatable-strings/edit/tabs.html';
import html from 'belt/content/js/translatable-strings/edit/template.html';

export default {
    data() {
        return {
            entity_type: 'translatableStrings',
            entity_id: this.$route.params.id,
            translatableString_id: this.$route.params.id,
        }
    },
    components: {
        tabs: {template: tabs_html},
    },
    template: html,
}