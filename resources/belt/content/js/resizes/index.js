import uploader from 'belt/content/js/base/uploader/ctlr';
import uploader_html from 'belt/content/js/base/uploader/template.html';
import Form from 'belt/content/js/resizes/form';
import UploadForm from 'belt/content/js/resizes/form-upload';
import Table from 'belt/content/js/resizes/table';
import edit from 'belt/content/js/resizes/edit';
import html from 'belt/content/js/resizes/templates/index.html';

export default {
    data() {
        return {
            morphable_id: this.$parent.morphable_id,
            table: new Table({
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    mounted() {
        this.table.index();
    },
    components: {
        uploader: {
            mixins: [uploader],
            data() {
                return {
                    table: this.$parent.table,
                    form: new UploadForm({
                        morphable_id: this.$parent.morphable_id,
                    }),
                }
            },
            methods: {
                onUploadSuccess() {
                    this.table.index();
                },
            },
            template: uploader_html
        },
        edit
    },
    template: html
}