import shared from 'belt/content/js/terms/ctlr/shared';
import termForm from 'belt/content/js/terms/ctlr/term-form';
import edit_html from 'belt/content/js/terms/templates/edit.html';

export default {
    mixins: [shared],
    components: {
        tab: termForm,
    },
    template: edit_html,
}