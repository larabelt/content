import Form from 'belt/content/js/resizes/form';
import html from 'belt/content/js/resizes/templates/edit.html';

export default {
    props: ['resize'],
    data() {
        return {
            table: this.$parent.table,
            form: new Form({
                entity_id: this.$parent.entity_id,
            }),
        }
    },
    mounted() {
        this.form.show(this.resize.id);
    },
    methods: {

    },
    template: html
}