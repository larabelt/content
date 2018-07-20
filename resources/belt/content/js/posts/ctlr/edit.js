import shared from 'belt/content/js/posts/ctlr/shared';
import subtypeDropdown from 'belt/content/js/subtypes/inputs/default';
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
                subtypeDropdown
            },
            template: form_html,
        },
    },
}