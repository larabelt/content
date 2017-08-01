import shared from 'belt/content/js/blocks/ctlr/edit-shared';

import form_html from 'belt/content/js/blocks/templates/form.html';

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