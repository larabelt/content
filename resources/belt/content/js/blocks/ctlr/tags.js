import shared from 'belt/content/js/blocks/ctlr/edit-shared';

// components
import tags from 'belt/glue/js/taggables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: tags,
    },
}