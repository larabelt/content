import shared from 'belt/content/js/components/pages/ctlr/shared';

// components
import handles from 'belt/content/js/components/handleables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: handles,
    },
}