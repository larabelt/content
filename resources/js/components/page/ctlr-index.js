import headingTemplate from 'belt/core/js/templates/heading2.html';
import indexTemplate from './templates/index.html';
import PageTable from './table';

export default {

    components: {
        heading: {template: headingTemplate},
        pageIndex: {
            data() {
                return {
                    table: new PageTable({router: this.$router}),
                }
            },
            mounted() {
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            template: indexTemplate,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Page Manager</span>
            </heading>
            <section class="content">
                <page-index></page-index>
            </section>
        </div>
        `
}