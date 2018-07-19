import listItem from 'belt/content/js/clippables/ctlr/list-item';
//import Form from 'belt/content/js/attachments/form';
import Form from 'belt/content/js/clippables/form';
import html from 'belt/content/js/clippables/templates/list.html';

export default {
    data() {
        return {
            item: {
                id: null,
            },
            detached: this.$parent.detached,
            table: this.$parent.table,
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
        }
    },
    components: {
        listItem,
    },
    template: html
}