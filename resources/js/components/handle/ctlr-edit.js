import handleableService from './service';
import handleableIndexTemplate from './templates/index';

export default {
    data() {
        return {
            handleable_type: this.$parent.morphable_type,
            handleable_id: this.$parent.morphable_id,
        }
    },
    components: {
        'handleable-index': {
            mixins: [handleableService],
            template: handleableIndexTemplate,
            data() {
                return {
                    handleable_type: this.$parent.handleable_type,
                    handleable_id: this.$parent.handleable_id,
                }
            },
            mounted() {
                this.paginate();
            },
        },
    },
    template: `
        <div>
            <handleable-index></handleable-index>
        </div>
        `
}