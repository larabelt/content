import headingTemplate from 'ohio/core/js/templates/heading2.html';
import indexTemplate from './templates/index.html';
import CategoryTable from './table';

export default {

    components: {
        heading: {template: headingTemplate},
        categoryIndex: {
            data() {
                return {
                    //table: new CategoryTable(),
                    paginator: new CategoryTable(),
                }
            },
            mounted() {
                //this.table.index();
                this.paginator.paginate();
                //this.paginator = this.table;
            },
            template: indexTemplate,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Category Manager</span>
            </heading>
            <section class="content">
                <category-index></category-index>
            </section>
        </div>
        `
}