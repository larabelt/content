import edit from 'belt/content/js/lists/edit/shared';
import sections from 'belt/content/js/sectionables/router';

export default {
    mixins: [edit],
    components: {
        edit: sections,
    },
}