import shared from 'belt/content/js/components/pages/ctlr/shared';

import form_html from 'belt/content/js/components/pages/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    form: this.$parent.form,
                }
            },
            template: form_html,
        },
    },
}