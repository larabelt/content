import shared from 'belt/content/js/blocks/ctlr/edit-shared';

// components
import categories from 'belt/glue/js/categorizables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: categories,
    },
}