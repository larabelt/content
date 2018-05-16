// helpers
import Form from 'belt/content/js/touts/form';

// templates make a change

import tabs_html from 'belt/content/js/touts/templates/tabs.html';
import edit_html from 'belt/content/js/touts/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            morphable_type: 'touts',
            morphable_id: this.$route.params.id,
        }
    },
    components: {
        tabs: {template: tabs_html},
    },
    computed: {
        tout() {
            return this.form;
        }
    },
    mounted() {
        this.form.show(this.morphable_id);
    },
    template: edit_html,
}