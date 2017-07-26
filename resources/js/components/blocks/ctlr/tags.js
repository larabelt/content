import shared from 'belt/content/js/components/blocks/ctlr/edit-shared';

// components
import tags from 'belt/glue/js/components/taggables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: tags,
    },
}