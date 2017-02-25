// helpers
import Form from '../form';

// templates
import editContent_html from '../templates/edit-content.html';

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
    template: editContent_html
}