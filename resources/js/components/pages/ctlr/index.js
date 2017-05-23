import debounce from 'debounce';

import tags from 'belt/glue/js/components/taggables/filter';

// helpers
import Form from '../form';
import Table from '../table';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import index_html from '../templates/index.html';

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
            components: {tags},
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