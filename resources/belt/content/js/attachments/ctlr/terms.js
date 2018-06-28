import shared from 'belt/content/js/attachments/ctlr/shared';

// components
import terms from 'belt/content/js/termables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: terms,
    },
}