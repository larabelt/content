import block from 'belt/content/js/blocks/store/mixin';
import edit from 'belt/content/js/blocks/edit/shared';
import params from 'belt/core/js/paramables/ctlr/index';

export default {
    mixins: [edit],
    components: {
        edit: {
            mixins: [block, params],
            data() {
                return {
                    morphable_type: 'blocks',
                    morphable_id: this.$parent.morphable_id,
                    block_id: this.$parent.morphable_id,
                }
            },
            mounted() {
                this.$store.dispatch(this.storeKey + '/params/load');
            }
        },
    },
}