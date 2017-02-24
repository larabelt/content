// helpers
import Form from '../form';

// templates
import editDefault_html from '../templates/edit-default.html';

export default {
    props: {
        section: {}
    },
    data() {
        let form = new Form();
        form.setData(this.section);
        return {
            form: form
        }
    },
    template: editDefault_html
}