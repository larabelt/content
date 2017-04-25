// components
import shared from './shared';

import create_html from '../templates/create.html';
import form_html from '../templates/form-create.html';

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