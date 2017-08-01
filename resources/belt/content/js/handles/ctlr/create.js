// components
import shared from 'belt/content/js/handles/ctlr/shared';

import create_html from 'belt/content/js/handles/templates/create.html';
import form_html from 'belt/content/js/handles/templates/form-create.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    form: this.$parent.form,
                }
            },
            mounted() {
                this.form.router = this.$router;
                this.form.routeEditName = 'handles.edit';
            },
            template: form_html,
        },
    },
    template: create_html,
}