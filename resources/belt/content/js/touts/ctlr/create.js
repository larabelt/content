// helpers
import Form from 'belt/content/js/touts/form';

// templates make a change

import form_html from 'belt/content/js/touts/templates/form.html';
import create_html from 'belt/content/js/touts/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    tout: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}