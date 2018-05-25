// templates

import tabs_html from 'belt/spot/js/itineraries/templates/tabs.html';
import edit_html from 'belt/spot/js/itineraries/templates/edit.html';

import Form from 'belt/spot/js/itineraries/form';

export default {
    data() {
        return {
            morphable_type: 'itineraries',
            morphable_id: this.$route.params.id,
            itinerary: new Form(),
        }
    },
    components: {

        tabs: {template: tabs_html},
    },
    mounted() {
        this.itinerary.show(this.morphable_id);
    },
    template: edit_html,
}