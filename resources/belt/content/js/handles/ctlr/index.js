import shared from 'belt/content/js/handles/ctlr/shared';

// helpers
import Table from 'belt/content/js/handles/table';

// templates make a change

import index_html from 'belt/content/js/handles/templates/index.html';

export default {
    components: {

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
                <span slot="help"><link-help docKey="admin.content.handles.manager"/></span>
                <li><router-link :to="{ name: 'handles' }">Handle Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}