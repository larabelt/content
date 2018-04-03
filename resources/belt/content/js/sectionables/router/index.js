import list from 'belt/content/js/sectionables/list';
import create from 'belt/content/js/sectionables/create';
import edit from 'belt/content/js/sectionables/edit';

export default {
    data() {
        return {
            morphable_type: this.$parent.morphable_type,
            morphable_id: this.$parent.morphable_id,
        }
    },
    computed: {
        route() {
            return this.$route.params.section_mode ? this.$route.params.section_mode : 'list';
        },
    },
    components: {
        list, create, edit,
    },
    template: `<div><component :is="route"></component></div>`
}