// components
import create from 'belt/content/js/sectionables/ctlr/create';

import shared from 'belt/content/js/sectionables/ctlr/shared';

// templates
import edit_html from 'belt/content/js/sectionables/sections/box/edit.html';

export default {
    mixins: [shared],
    components: {
        create,
    },
    template: edit_html
}