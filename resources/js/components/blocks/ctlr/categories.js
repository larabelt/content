import shared from 'belt/content/js/components/blocks/ctlr/edit-shared';

// components
import categories from 'belt/glue/js/components/categorizables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: categories,
    },
}