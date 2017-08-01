import shared from 'belt/content/js/pages/ctlr/shared';

// components
import sections from 'belt/content/js/sectionables/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: sections,
    },
}