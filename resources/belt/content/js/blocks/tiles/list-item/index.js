import Form from 'belt/content/js/blocks/form';
import tile from 'belt/core/js/tiles/default';
import html from 'belt/content/js/blocks/tiles/default/template.html';

export default {
    mixins: [tile],
    data() {
        return {
            form: new Form(),
            entity_type: 'blocks',
        }
    },
    computed: {
        id() {
            let param = _.find(this.params, {
                key: 'blocks',
            });

            return _.get(param, 'value');
        },
        name() {
            return _.get(this.block, 'name', '');
        },
        block() {
            return this.form;
        },
        summary() {
            let content = _.get(this.block, 'body', _.get(this.block, 'intro', _.get(this.block, 'meta_description', '')));

            if (content.length > 100) {
                content = content.substring(0, 100) + '...';
            }

            return content.replace(/<\/?[^>]+(>|$)/g, "");
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
    template: html,
}