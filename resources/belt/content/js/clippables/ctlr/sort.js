import shared from 'belt/content/js/clippables/shared';
import Form from 'belt/content/js/clippables/form';
import listItem from 'belt/content/js/clippables/list-item';
import html from 'belt/content/js/clippables/templates/sort.html';

export default {
    mixins: [shared],
    data() {
        return {
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            morphable_type: this.$parent.morphable_type,
            morphable_id: this.$parent.morphable_id,
            //table: this.$parent.table,
        }
    },

    components: {listItem},
    template: html
}