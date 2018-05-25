import list from 'belt/content/js/lists/store/mixin';
import edit from 'belt/content/js/lists/edit/shared';
import params from 'belt/core/js/paramables/ctlr/index';

export default {
    mixins: [edit],
    components: {
        edit: {
            mixins: [list, params],
            data() {
                return {
                    morphable_type: 'lists',
                    morphable_id: this.$parent.morphable_id,
                    list_id: this.$parent.morphable_id,
                }
            },
            mounted() {
                this.$store.dispatch(this.storeKey + '/params/load');
            }
        },
    },
}