import uploader from 'belt/content/js/base/uploader/ctlr';
import Table from 'belt/content/js/attachments/table';

import index_html from 'belt/content/js/attachments/templates/index.html';
import uploader_html from 'belt/content/js/base/uploader/template.html';

export default {

    components: {

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
                filter: _.debounce(function (query) {
                    if (query) {
                        query.page = 1;
                        this.table.updateQuery(query);
                    }
                    this.table.index()
                        .then(() => {
                            this.table.pushQueryToHistory();
                            this.table.pushQueryToRouter();
                        });
                }, 300),
            },
            components: {
                uploader: {
                    mixins: [uploader],
                    methods: {
                        onUploadSuccess(attachment) {
                            this.$router.push({name: 'attachments.edit', params: {id: attachment.id}});
                        },
                    },
                    template: uploader_html
                },
            },
            template: index_html,
        },
    },

    template: `
        <div>
            <heading>
                <span slot="title">Attachment Manager</span>
                <span slot="help"><link-help docKey="admin.content.attachments.manager"/></span>
                <li><router-link :to="{ name: 'attachments' }">Attachment Manager</router-link></li>
            </heading>
            <section class="content">
                <index></index>
            </section>
        </div>
        `
}