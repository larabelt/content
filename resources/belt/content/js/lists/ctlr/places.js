import shared from 'belt/spot/js/lists/ctlr/shared';

// components
import places from 'belt/spot/js/listables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: places,
    },
}