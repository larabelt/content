import shared from 'belt/content/js/pages/ctlr/shared';

// components
import attachments from 'belt/content/js/clippables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: attachments,
    },
}