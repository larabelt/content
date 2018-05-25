import shared from 'belt/spot/js/itineraries/ctlr/shared';
import attachment from 'belt/clip/js/clippables/ctlr/attachment';
import priorityDropdown from 'belt/core/js/inputs/priority/form';
import templateDropdown from 'belt/content/js/templates';
import Form from 'belt/spot/js/itineraries/form';

import tabs_html from 'belt/spot/js/itineraries/templates/tabs.html';
import edit_html from 'belt/spot/js/itineraries/templates/edit.html';
import form_html from 'belt/spot/js/itineraries/templates/form.html';

export default {
    data() {
        return {
            morphable_type: 'itineraries',
            morphable_id: this.$route.params.id,
            itinerary: new Form(),
        }
    },
    mounted() {
        this.itinerary.show(this.morphable_id);
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