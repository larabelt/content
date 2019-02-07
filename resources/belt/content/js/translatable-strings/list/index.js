import Table from 'belt/content/js/translatable-strings/table';
import html from 'belt/content/js/translatable-strings/list/template.html';

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
                            this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }, 300),
            },
            template: html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Translatable String Manager</span>
                <span slot="help"><link-help docKey="admin.content.translatable_strings.manager" /></span>
                <li><router-link :to="{ name: 'translatableStrings' }">Translatable String Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}