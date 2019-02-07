// helpers
import Form from 'belt/content/js/pages/form';
import Table from 'belt/content/js/pages/table';

// templates make a change

import index_html from 'belt/content/js/pages/templates/index.html';

export default {
    data() {
        return {
            entity_type: 'places',
            entity_id: null,
        }
    },
    components: {

        index: {
            data() {
                return {
                    entity_type: 'places',
                    table: new Table({router: this.$router, query: {term: null}}),
                }
            },
            mounted() {
                this.table.updateQueryFromHistory();
                this.table.updateQueryFromRouter();
                this.table.pushQueryToRouter();
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
                            this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }, 300),
                copy(id) {
                    let form = new Form();
                    form.service.baseUrl = '/api/v1/pages/?source=' + id;
                    form.router = this.$router;
                    form.submit();
                }
            },
            template: index_html,
        },
    },
    template: `
        <div>
            <heading>
                <span slot="title">Page Manager</span>
                <span slot="help"><link-help docKey="admin.content.pages.manager"/></span>
                <li><router-link :to="{ name: 'pages' }">Page Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}