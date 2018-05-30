import shared from 'belt/content/js/blocks/ctlr/edit-shared';

// components
import terms from 'belt/content/js/termables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: terms,
    },
}