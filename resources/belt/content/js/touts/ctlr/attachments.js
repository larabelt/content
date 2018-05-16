
// components
import attachments from 'belt/clip/js/attachables/ctlr/index';

// templates

import tabs_html from 'belt/content/js/touts/templates/tabs.html';
import attachment_html from 'belt/content/js/touts/templates/attachments.html';

export default {
    data() {
        return {
            morphable_type: 'touts',
            morphable_id: this.$route.params.id
        }
    },
    components: {

        tabs: {template: tabs_html},
        attachments: attachments,
    },
    template: attachment_html,
}