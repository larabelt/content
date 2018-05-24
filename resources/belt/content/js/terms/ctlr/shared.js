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
            morphable_type: 'terms',
            morphable_id: this.$route.params.id,
        }
    },
    components: {
        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.morphable_id)
            .then(() => {
                if (this.form.parent_id) {
                    console.log('parent');
                    this.parentTerm.show(this.form.parent_id);
                }
            });
    },
    template: edit_html,
}