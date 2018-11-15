import Form from 'belt/content/js/translatable-strings/form';
import form_html from 'belt/content/js/translatable-strings/create/form.html';
import html from 'belt/content/js/translatable-strings/create/template.html';

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
    template: html
}