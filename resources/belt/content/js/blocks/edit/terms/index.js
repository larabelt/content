import edit from 'belt/content/js/blocks/edit/shared';
import terms from 'belt/content/js/termables/ctlr-edit';

export default {
    mixins: [edit],
    components: {
        edit: terms,
    },
}