import shared from 'belt/content/js/sectionables/shared';
import list from 'belt/content/js/sectionables/list';
import create from 'belt/content/js/sectionables/create';
import edit from 'belt/content/js/sectionables/edit';
import html from 'belt/content/js/sectionables/router/template.html';

export default {
    mixins: [shared],
    computed: {
        route() {
            return this.$route.params.section_mode ? this.$route.params.section_mode : 'list';
        },
    },
    components: {
        list, create, edit,
    },
    template: html,
}