import shared from 'belt/content/js/posts/ctlr/shared';
import terms from 'belt/content/js/termables/ctlr-edit';

export default {
    mixins: [shared],
    components: {
        tab: terms,
    },
}