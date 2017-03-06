
export default {
    props: {
        section: {},
    },
    data() {
        return {
            shared: this.$parent.shared,
            morphable_id: this.$parent.shared.morphable_id,
            morphable_type: this.$parent.shared.morphable_type,
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
        mouseout(e) {
            this.shared.dragAndDrop = {
                active: '',
                position: '',
                trashing: '',
                dragging: {
                    id: '',
                    type: '',
                },
                dropping: {
                    id: '',
                    position: '',
                },
            };
        }
    },
}