import edit from 'belt/content/js/lists/edit/shared';
import attachments from 'belt/clip/js/clippables/ctlr/index';

export default {
    mixins: [edit],
    components: {
        edit: attachments,
    },
}