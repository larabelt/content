import shared from 'belt/content/js/pages/ctlr/shared';
import templateDropdown from 'belt/content/js/templates';
import form_html from 'belt/content/js/pages/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    form: this.$parent.form,
                }
            },
            components: {
                templateDropdown
            },
            template: form_html,
        },
    },
}