// helpers
import Form from '../form';

// templates
import editItem_html from '../templates/edit-item.html';

// section items
import itemBlock from 'belt/content/js/components/blocks/sections/edit';
import itemSection from '../sections/edit.vue'

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
            table: this.$parent.table,
        }
    },
    components: {
        itemBlock,
        itemSection,
    },
    template: editItem_html
}