import shared from 'belt/content/js/posts/ctlr/shared';
import templateDropdown from 'belt/content/js/templates/inputs/default';
import form_html from 'belt/content/js/posts/templates/form.html';

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