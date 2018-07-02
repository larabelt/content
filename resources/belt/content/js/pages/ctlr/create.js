// helpers
import Form from 'belt/content/js/pages/form';

// templates make a change

import form_html from 'belt/content/js/pages/templates/form.html';
import create_html from 'belt/content/js/pages/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    form: new Form({router: this.$router}),
                }
            },
            methods: {
                submit() {
                    Events.$emit('pages:' + this.morphable_id + ':saving', this.form);
                    this.form.submit();
                }
            },
            template: form_html,
        },
    },
    template: create_html
}