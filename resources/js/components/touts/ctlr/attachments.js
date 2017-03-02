
// components
import attachments from 'belt/clip/js/components/attachables/ctlr/index';

// templates
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from '../templates/tabs.html';
import attachment_html from '../templates/attachments.html';

export default {
    data() {
        return {
            morphable_type: 'touts',
            morphable_id: this.$route.params.id
        }
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
        attachments: attachments,
    },
    template: attachment_html,
}