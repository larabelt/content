import shared from 'belt/spot/js/itineraries/ctlr/shared';

// components
import attachments from 'belt/clip/js/clippables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: attachments,
    },
}