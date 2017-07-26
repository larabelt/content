import shared from 'belt/content/js/components/posts/ctlr/shared';

// components
import handles from 'belt/content/js/components/handleables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: handles,
    },
}