import Form from 'belt/content/js/blocks/form';


import form_html from 'belt/content/js/blocks/create/form.html';
import create_html from 'belt/content/js/blocks/create/template.html';

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