import shared from 'belt/content/js/components/posts/ctlr/shared';

// components
import sections from 'belt/content/js/components/sectionables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: sections,
    },
}