import shared from 'belt/content/js/attachments/ctlr/shared';

// components
import resizes from 'belt/content/js/resizes/index';

export default {
    mixins: [shared],
    components: {
        tab: resizes,
    },
}