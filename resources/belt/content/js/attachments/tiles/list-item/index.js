import Form from 'belt/content/js/attachments/form';
import thumb from 'belt/content/js/attachments/thumb';
import tile from 'belt/core/js/tiles/default';
import html from 'belt/content/js/attachments/tiles/default/template.html';

export default {
    mixins: [tile],
    data() {
        return {
            form: new Form(),
            entity_type: 'attachments',
        }
    },
    computed: {
        id() {
            let param = _.find(this.params, {
                key: 'attachments',
            });

            return _.get(param, 'value');
        },
        name() {
            return _.get(this.attachment, 'name', '');
        },
        attachment() {
            return this.form;
        },
        summary() {
            let content = _.get(this.attachment, 'body', _.get(this.attachment, 'intro', _.get(this.attachment, 'meta_description', '')));

            if (content.length > 100) {
                content = content.substring(0, 100) + '...';
            }

            return content.reattachment(/<\/?[^>]+(>|$)/g, "");
        },
    },
    watch: {
        'id': function (id) {
            if (id) {
                this.form.show(this.id);
            }
        }
    },
    mounted() {
        this.form.show(this.id);
    },
    components: {
        thumb
    },
    template: html,
}