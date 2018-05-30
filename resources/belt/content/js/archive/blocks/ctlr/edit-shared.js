// helpers
import Form from 'belt/content/js/blocks/form';

// templates make a change

import tabs_html from 'belt/content/js/blocks/templates/tabs.html';
import edit_html from 'belt/content/js/blocks/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            morphable_type: 'blocks',
            morphable_id: this.$route.params.id,
        }
    },
    components: {

        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.morphable_id);
    },
    template: edit_html,
}