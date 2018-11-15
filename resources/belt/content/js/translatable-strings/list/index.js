// helpers
import Table from 'belt/content/js/translatable-strings/table';

// templates make a change

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
            template: html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">TranslationString Manager</span>
                <li><router-link :to="{ name: 'translatableStrings' }">TranslationString Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}