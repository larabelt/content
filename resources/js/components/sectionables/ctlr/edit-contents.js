// helpers
import Form from '../form';

// templates
import editContents_html from '../templates/edit-contents.html';

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
    template: editContents_html
}