// helpers
import Table from './table';

// templates
import index_html from './templates/index.html';

export default {
    data() {
        return {
            table: new Table(),
            item: {},
        }
    },
    template: index_html
}