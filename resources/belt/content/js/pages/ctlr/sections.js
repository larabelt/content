import shared from 'belt/content/js/pages/ctlr/shared';

// components
import sections from 'belt/content/js/sectionables/router/index';

export default {
    mixins: [shared],
    components: {
        tab: sections,
    },
}