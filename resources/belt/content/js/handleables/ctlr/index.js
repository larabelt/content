// helpers
import Form from 'belt/content/js/handleables/form';
import Table from 'belt/content/js/handleables/table';

import edit from 'belt/content/js/handleables/ctlr/edit';

// templates
import index_html from 'belt/content/js/handleables/templates/index.html';

export default {
    data() {
        return {
            entity_type: this.$parent.entity_type,
            entity_id: this.$parent.entity_id,
            table: new Table({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
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
                .then(() => {
                    this.table.index();
                    this.form.reset()
                })
        }
    },
    template: index_html
}