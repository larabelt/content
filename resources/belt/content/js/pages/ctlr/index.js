import debounce from 'debounce';

import filterSearch from 'belt/core/js/inputs/filter-search';
import filterTags from 'belt/glue/js/inputs/filter-tags/filter';
import filterTagsAttached from 'belt/glue/js/inputs/filter-tags/attached';
import filterTagsDetached from 'belt/glue/js/inputs/filter-tags/detached';

// helpers
import Form from 'belt/content/js/pages/form';
import Table from 'belt/content/js/pages/table';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import index_html from 'belt/content/js/pages/templates/index.html';

export default {
    data() {
        return {
            morphable_type: 'places',
            morphable_id: null,
        }
    },
    components: {
        heading: {template: heading_html},
        index: {
            data() {
                return {
                    morphable_type: 'places',
                    table: new Table({router: this.$router, query: {tag: null}}),
                }
            },
            mounted() {
                this.table.updateQueryFromHistory();
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            methods: {
                filter: debounce(function (query) {
                    if (query) {
                        query.page = 1;
                        this.table.updateQuery(query);
                    }
                    this.table.index()
                        .then(() => {
                            this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }),
                copy(id) {
                    let form = new Form();
                    form.service.baseUrl = '/api/v1/pages/?source=' + id;
                    form.router = this.$router;
                    form.submit();
                }
            },
            components: {
                filterSearch,
                filterTags,
                filterTagsAttached,
                filterTagsDetached,
            },
            template: index_html,
        },
    },
    template: `
        <div>
            <heading>
                <span slot="title">Page Manager</span>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}