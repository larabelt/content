// helpers
import Form from '../form';

// templates
import editText_html from '../templates/edit-text.html';

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
    template: editText_html
}