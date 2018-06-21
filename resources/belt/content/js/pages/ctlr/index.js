import filterSearch from 'belt/core/js/inputs/filter-search';
import filterTerms from 'belt/content/js/inputs/filter-terms/filter';
import filterTermsAttached from 'belt/content/js/inputs/filter-terms/attached';
import filterTermsDetached from 'belt/content/js/inputs/filter-terms/detached';

// helpers
import Form from 'belt/content/js/pages/form';
import Table from 'belt/content/js/pages/table';

// templates make a change

import index_html from 'belt/content/js/pages/templates/index.html';

export default {
    data() {
        return {
            morphable_type: 'places',
            morphable_id: null,
        }
    },
    components: {

        index: {
            data() {
                return {
                    morphable_type: 'places',
                    table: new Table({router: this.$router, query: {tag: null}}),
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
            components: {
                filterSearch,
                filterTerms,
                filterTermsAttached,
                filterTermsDetached,
            },
            template: index_html,
        },
    },
    template: `
        <div>
            <heading>
                <span slot="title">Page Manager</span>
                <li><router-link :to="{ name: 'pages' }">Page Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}