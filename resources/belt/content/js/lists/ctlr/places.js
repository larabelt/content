import shared from 'belt/content/js/lists/ctlr/shared';

// components
import places from 'belt/content/js/listables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: places,
    },
}