// helpers
import Form from 'belt/spot/js/itineraries/form';

// templates make a change

import form_html from 'belt/spot/js/itineraries/templates/form.html';
import create_html from 'belt/spot/js/itineraries/templates/create.html';

export default {
    components: {

        create: {
            data() {
                return {
                    itinerary: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}