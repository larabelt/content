
// components
import tags from 'belt/glue/js/components/taggables/ctlr-edit';

// templates
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from '../templates/tabs.html';
import edit_html from '../templates/edit.html';

export default {
    data() {
        return {
            morphable_type: 'pages',
            morphable_id: this.$route.params.id
        }
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
        edit: tags,
    },
    template: edit_html,
}