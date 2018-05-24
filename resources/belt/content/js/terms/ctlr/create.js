import shared from 'belt/content/js/terms/ctlr/shared';
import Form from 'belt/content/js/terms/form';
import termForm from 'belt/content/js/terms/ctlr/term-form';

// templates make a change

import form_html from 'belt/content/js/terms/templates/form.html';
import create_html from 'belt/content/js/terms/templates/create.html';

export default {
    mixins: [shared],
    components: {

        create: {
            mixins: [termForm],
            data() {
                return {
                    form: new Form({router: this.$router}),
                }
            },
        },
        create1: {
            data() {
                return {
                    form: new Form({router: this.$router}),
                    parentTerm: this.$parent.parentTerm,
                }
            },
            template: form_html,
        },
    },
    template: create_html
}