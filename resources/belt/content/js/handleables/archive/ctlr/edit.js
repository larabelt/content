// helpers
import Form from 'belt/content/js/handleables/form';

import shared from 'belt/content/js/handleables/ctlr/shared';

// templates
import edit_html from 'belt/content/js/handleables/templates/edit.html';

export default {
    mixins: [shared],
    props: ['handle'],
    data() {
        return {
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
        }
    },
    mounted() {

    },
    methods: {
        makeDefault() {
            this.form.setData(this.handle);
            this.form.is_default = true;
            this.form.submit()
                .then(() => {
                    this.table.index();
                });
        }
    },
    template: edit_html
}