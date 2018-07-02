import shared from 'belt/content/js/pages/ctlr/shared';

// components
import tags from 'belt/glue/js/taggables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: tags,
    },
}