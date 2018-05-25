import shared from 'belt/content/js/lists/ctlr/shared';
import attachment from 'belt/clip/js/clippables/ctlr/attachment';
import priorityDropdown from 'belt/core/js/inputs/priority/form';
import templateDropdown from 'belt/content/js/templates';
import Form from 'belt/content/js/lists/form';

import tabs_html from 'belt/content/js/lists/templates/tabs.html';
import edit_html from 'belt/content/js/lists/templates/edit.html';
import form_html from 'belt/content/js/lists/templates/form.html';

export default {
    data() {
        return {
            morphable_type: 'lists',
            morphable_id: this.$route.params.id,
            list: new Form(),
        }
    },
    mounted() {
        this.list.show(this.morphable_id);
    },
    components: {

        tabs: {template: tabs_html},
        tab: {
            mixins: [shared],
            components: {
                attachment,
                priorityDropdown,
                templateDropdown,
            },
            template: form_html,
        },
    },
    template: edit_html,
}