import Form from 'belt/content/js/sectionables/form';
import TreeForm from 'belt/content/js/sectionables/tree';

export default {
    props: {
        morphable_id: {
            default: function () {
                return this.$parent.morphable_id;
            }
        },
        morphable_type: {
            default: function () {
                return this.$parent.morphable_type;
            }
        },
    },
    data() {
        return {

        }
    },
    computed: {
        configs2() {
            return this.$store.getters['configs/data'];
        },
        configs() {
            return _.get(this.$store.getters['configs/data'], 'sections');
        },
    },
    mounted() {
        if (!_.has(this.$store.getters['configs/data'], 'sections')) {
            this.$store.dispatch('configs/loadType', 'sections');
        }
    },
}