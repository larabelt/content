import shared from './shared';

// helpers
import Table from '../table';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import index_html from '../templates/index.html';

export default {
    components: {
        heading: {template: heading_html},
        index: {
            mixins: [shared],
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
                toggleActive(handle) {
                    handle.is_active = !handle.is_active;
                    this.form.setData(handle);
                    this.form.submit()
                        .then(() => {
                            this.table.index();
                        });
                },
            },
            template: index_html,
        },
    },
    template: `
        <div>
            <heading>
                <span slot="title">Handle Manager</span>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}