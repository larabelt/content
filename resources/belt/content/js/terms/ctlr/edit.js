import shared from 'belt/content/js/terms/ctlr/shared';
import Table from 'belt/content/js/terms/table';

import parentTerms from 'belt/content/js/terms/ctlr/index-table';
import termForm from 'belt/content/js/terms/ctlr/term-form';

import edit_html from 'belt/content/js/terms/templates/edit.html';
import form_html from 'belt/content/js/terms/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: termForm,
    },
    template: edit_html,
}