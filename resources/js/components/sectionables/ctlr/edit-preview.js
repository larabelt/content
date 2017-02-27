// helpers
import Form from '../form';

// templates
import editPreview_html from '../templates/edit-preview.html';

export default {
    props: {
        section: {}
    },
    data() {
        let form = new Form();
        form.setData(this.section);
        return {
            config: this.$parent.config,
            form: form,
            preview: {
                html: ''
            }
        }
    },
    mounted() {
        let preview = this.preview;
        this.form.service.get(this.section.id + '/preview')
            .then(function (response) {
                console.log(response);
                preview.html = response.data;
            });
    },
    template: editPreview_html
}