// helpers
import Form from 'belt/content/js/handleables/form';
import Table from 'belt/content/js/handleables/table';

import edit from 'belt/content/js/handleables/ctlr/edit';

// templates
import index_html from 'belt/content/js/handleables/templates/index.html';

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