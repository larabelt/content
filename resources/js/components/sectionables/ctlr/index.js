// components
import edit from './edit';

// helpers
import Form from '../form';
import Table from '../table';

// templates
import index_html from '../templates/index.html';

export default {
    data() {
        return {
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    components: {
        pageSection: edit,
    },
    created() {
        this.table.index();
    },
    template: index_html
}