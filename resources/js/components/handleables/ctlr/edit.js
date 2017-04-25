// helpers
import Form from '../form';
import Table from '../table';

import shared from './shared';

// templates
import edit_html from '../templates/edit.html';

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