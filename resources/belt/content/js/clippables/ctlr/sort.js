import shared from 'belt/content/js/clippables/shared';
import Form from 'belt/content/js/clippables/form';
import listItem from 'belt/content/js/clippables/list-item';
import html from 'belt/content/js/clippables/templates/sort.html';

export default {
    mixins: [shared],
    data() {
        return {
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            entity_type: this.$parent.entity_type,
            entity_id: this.$parent.entity_id,
            //table: this.$parent.table,
        }
    },

    components: {listItem},
    template: html
}