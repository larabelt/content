// templates

import tabs_html from 'belt/spot/js/lists/templates/tabs.html';
import edit_html from 'belt/spot/js/lists/templates/edit.html';

import Form from 'belt/spot/js/lists/form';

export default {
    data() {
        return {
            morphable_type: 'lists',
            morphable_id: this.$route.params.id,
            list: new Form(),
        }
    },
    components: {

        tabs: {template: tabs_html},
    },
    mounted() {
        this.list.show(this.morphable_id);
    },
    template: edit_html,
}