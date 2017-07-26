import tags from 'belt/glue/js/components/taggables/filter';

// helpers
import Table from 'belt/content/js/components/posts/table';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import index_html from 'belt/content/js/components/posts/templates/index.html';

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
            components: {tags},
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Post Manager</span>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}