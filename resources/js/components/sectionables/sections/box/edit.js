// components
import create from '../../ctlr/create';

import shared from 'belt/content/js/components/sectionables/ctlr/panel-shared';

// templates
import edit_html from './edit.html';

export default {
    mixins: [shared],
    components: {
        create,
    },
    template: edit_html
}