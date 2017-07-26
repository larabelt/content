// helpers
import Table from 'belt/content/js/components/searchables/table';

// templates
import index_html from 'belt/content/js/components/searchables/templates/index.html';

export default {
    data() {
        return {
            table: new Table(),
            item: {},
        }
    },
    template: index_html
}