// helpers
import Table from 'belt/content/js/touts/table';

// templates make a change

import index_html from 'belt/content/js/touts/templates/index.html';

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
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Tout Manager</span>
                <li><router-link :to="{ name: 'touts' }">Tout Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}