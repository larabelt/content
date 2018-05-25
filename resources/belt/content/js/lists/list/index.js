import filterPriority from 'belt/core/js/inputs/priority/filter';
import filterSearch from 'belt/core/js/inputs/filter-search';
import Form from 'belt/content/js/lists/form';
import Table from 'belt/content/js/lists/table';

import index_html from 'belt/content/js/lists/list/template.html';

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
                    form.service.baseUrl = '/api/v1/lists/?source=' + id;
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
                <span slot="title">List Manager</span>
                <li><router-link :to="{ name: 'lists' }">List Manager</router-link></li>
            </heading>
            <section class="content-subheader">
                <p class="text-muted">{{ trans('belt-content::lists.manager.overall') }}</p>
            </section>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}