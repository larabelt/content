import filterPriority from 'belt/core/js/inputs/priority/filter';
import filterSearch from 'belt/core/js/inputs/filter-search';
import Form from 'belt/spot/js/itineraries/form';
import Table from 'belt/spot/js/itineraries/table';

import index_html from 'belt/spot/js/itineraries/templates/index.html';

export default {

    components: {

        index: {
            data() {
                return {
                    table: new Table({router: this.$router}),
                }
            },
            mounted() {
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            methods: {
                filter: _.debounce(function (query) {
                    if (query) {
                        query.page = 1;
                        this.table.updateQuery(query);
                    }
                    this.table.index()
                        .then(() => {
                            //this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }, 750),
                copy(id) {
                    let form = new Form();
                    form.service.baseUrl = '/api/v1/itineraries/?source=' + id;
                    form.router = this.$router;
                    form.submit();
                }
            },
            components: {
                filterPriority,
                filterSearch,
            },
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Itinerary Manager</span>
                <li><router-link :to="{ name: 'itineraries' }">Itinerary Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}