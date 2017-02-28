// helpers
import Form from '../form';

export default {
    props: {
        section: {},
    },
    data() {
        let shared = this.$parent.shared;
        return {
            shared: shared,
            morphable_id: shared.morphable_id,
            morphable_type: shared.morphable_type,
        }
    },
    computed: {
        dropdown() {
            if (this.section) {
                return this.shared.config.dropdown(this.section.sectionable_type);
            }
            return [];
        },
    },
    methods: {
        isType(type) {
            if (this.section) {
                return this.section.sectionable_type == type;
            }
            return false;
        },
    },
}