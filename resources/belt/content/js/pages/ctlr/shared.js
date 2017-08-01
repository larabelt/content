// helpers
import Form from 'belt/content/js/pages/form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from 'belt/content/js/pages/templates/tabs.html';
import edit_html from 'belt/content/js/pages/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            morphable_type: 'pages',
            morphable_id: this.$route.params.id,
        }
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.morphable_id);
    },
    template: edit_html,
}