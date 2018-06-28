import shared from 'belt/content/js/terms/ctlr/shared';

// components
import attachments from 'belt/content/js/clippables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: attachments,
    },
}