// helpers
import Table from 'belt/content/js/blocks/table';

// templates make a change

import index_html from 'belt/content/js/blocks/templates/index.html';

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
                <span slot="title">Block Manager</span>
                <li><router-link :to="{ name: 'blocks' }">Block Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}