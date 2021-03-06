import Form from 'belt/content/js/lists/form';


import form_html from 'belt/content/js/lists/create/form.html';
import create_html from 'belt/content/js/lists/create/template.html';

export default {
    components: {

        create: {
            data() {
                return {
                    form: new Form({router: this.$router}),
                }
            },
            components: {

            },
            template: form_html,
        },
    },
    template: create_html
}