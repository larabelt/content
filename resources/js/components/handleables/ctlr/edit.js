// helpers
import Form from 'belt/content/js/components/handleables/form';

import shared from 'belt/content/js/components/handleables/ctlr/shared';

// templates
import edit_html from 'belt/content/js/components/handleables/templates/edit.html';

export default {
    mixins: [shared],
    props: ['handle'],
    data() {
        return {
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
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