
export default {
    props: {
        section: {},
    },
    data() {
        return {
            morphable_id: this.$parent.morphable_id,
            morphable_type: this.$parent.morphable_type,
            configs: this.$parent.configs,
            dragAndDrop: this.$parent.dragAndDrop,
            panels: this.$parent.panels,
            table: this.$parent.table,
            tabs: this.$parent.tabs,
        }
    },
    computed: {
        dropdown() {
            if (this.section) {
                return this.configs.dropdown(this.section.sectionable_type);
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
            this.dragAndDrop = {
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