// helpers
import Form from '../form';
import Table from '../table';

import edit from './edit';

// templates
import index_html from '../templates/index.html';

export default {
    data() {
        return {
            morphable_type: this.$parent.morphable_type,
            morphable_id: this.$parent.morphable_id,
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    mounted() {
        this.table.index();
    },
    components: {
        edit,
    },
    methods: {
        store() {
            this.form.store()
                .then(response => {
                    this.table.index();
                })
        }
    },
    template: index_html
}