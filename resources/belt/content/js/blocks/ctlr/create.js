// helpers
import Form from 'belt/content/js/blocks/form';

// templates make a change

import form_html from 'belt/content/js/blocks/templates/form.html';
import create_html from 'belt/content/js/blocks/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    //async: false,
                    form: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}