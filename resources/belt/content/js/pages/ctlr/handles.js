import shared from 'belt/content/js/pages/ctlr/shared';
import HandleableManager from 'belt/content/js/handleables/Manager';

export default {
    mixins: [shared],
    components: {
        tab: HandleableManager,
    },
}