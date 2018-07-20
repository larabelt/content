

import Form from 'belt/content/js/blocks/form';
import Table from 'belt/content/js/blocks/table';

import index_html from 'belt/content/js/blocks/list/template.html';

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
                    form.service.baseUrl = '/api/v1/blocks/?source=' + id;
                    form.router = this.$router;
                    form.submit();
                }
            },
            components: {
                
                
            },
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Block Manager</span>
                <li><router-link :to="{ name: 'blocks' }">Block Manager</router-link></li>
            </heading>
            <section class="content-subheader">
                <p class="text-muted">{{ trans('belt-content::blocks.manager.overall') }}</p>
            </section>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}