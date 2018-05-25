// components
import shared from 'belt/content/js/sectionables/ctlr/shared';

// helpers
import Form from 'belt/spot/js/itineraries/form';
import Table from 'belt/spot/js/itineraries/table';

// templates
import edit_html from 'belt/spot/js/itineraries/sections/edit.html';

export default {
    mixins: [shared],
    data() {
        return {
            table: new Table({query: {perPage: 20}}),
            itinerary: new Form(),
        }
    },
    mounted() {
        if (this.section.sectionable_id) {
            console.log(111);
            this.itinerary.show(this.section.sectionable_id)
                .then(() => {
                    console.log(222);
                    console.log(this.itinerary);
                });
        }
    },
    methods: {
        update(id)
        {
            let form = this.active;
            let itinerary = this.itinerary;
            let table = this.table;

            form.sectionable_id = id;

            form.submit()
                .then(function () {
                    table.query.q = '';
                    table.items = [];
                    itinerary.show(form.sectionable_id);
                });
        }
    },
    template: edit_html
}