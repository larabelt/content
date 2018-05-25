// helpers
import Form from 'belt/spot/js/lists/form';

// templates make a change

import form_html from 'belt/spot/js/lists/templates/form.html';
import create_html from 'belt/spot/js/lists/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    list: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}