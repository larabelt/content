import shared from 'belt/content/js/posts/ctlr/shared';

// components
import handles from 'belt/content/js/handleables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: handles,
    },
}