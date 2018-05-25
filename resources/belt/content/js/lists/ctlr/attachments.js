import shared from 'belt/spot/js/lists/ctlr/shared';

// components
import attachments from 'belt/clip/js/clippables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: attachments,
    },
}