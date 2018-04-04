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
        return {}
    },
    computed: {
        configs() {
            return _.get(this.$store.getters['configs/data'], 'sections');
        },
    },
    methods: {
        go(mode, id, query) {
            this.$router.push({
                params: {
                    section_mode: mode,
                    section_id: id,
                },
                query: {
                    mode: _.get(query, 'mode'),
                    relative_id: _.get(query, 'relative_id'),
                }
            });
        },
        moveSection(id, relative_id, position) {
            return new Promise((resolve, reject) => {
                let tree = new TreeForm({
                    section_id: id,
                    neighbor_id: relative_id,
                    move: position
                });
                tree.submit()
                    .then(() => {
                        resolve();
                    })
                    .catch(() => {
                        reject();
                    });
            });
        },
    },
    mounted() {
        if (!_.has(this.$store.getters['configs/data'], 'sections')) {
            this.$store.dispatch('configs/loadType', 'sections');
        }
    },
}