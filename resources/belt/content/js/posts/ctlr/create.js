// helpers
import Form from 'belt/content/js/posts/form';


// templates make a change

import form_html from 'belt/content/js/posts/templates/form.html';
import create_html from 'belt/content/js/posts/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    form: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}