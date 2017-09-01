import debounce from 'debounce';

import filterSet from 'belt/core/js/inputs/filter-set';
import filterSearch from 'belt/core/js/inputs/filter-search';
import tags from 'belt/glue/js/taggables/filter';

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
                    table: new Table({router: this.$router}),
                }
            },
            mounted() {
                this.table.updateQueryFromHisory();
                this.table.updateQueryFromRouter();
                this.table.index();
            },
            methods: {
                filter: debounce(function () {
                    this.table.index();
                }),
                copy(id) {
                    let form = new Form();
                    form.service.baseUrl = '/api/v1/pages/?source=' + id;
                    form.router = this.$router;
                    form.submit();
                }
            },
            components: {
                filterSet: {
                    mixins: [filterSet],
                    components: {
                        slot1: filterSearch,
                    },
                },
                tags
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