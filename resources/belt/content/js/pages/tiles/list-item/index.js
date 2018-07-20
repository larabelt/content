import Form from 'belt/content/js/pages/form';
import tile from 'belt/core/js/tiles/default';
import html from 'belt/content/js/pages/tiles/default/template.html';

export default {
    mixins: [tile],
    data() {
        return {
            form: new Form(),
            entity_type: 'pages',
        }
    },
    computed: {
        id() {
            let param = _.find(this.params, {
                key: 'pages',
            });

            return _.get(param, 'value');
        },
        name() {
            return _.get(this.page, 'name', '');
        },
        page() {
            return this.form;
        },
        summary() {
            let content = _.get(this.page, 'body', _.get(this.page, 'intro', _.get(this.page, 'meta_description', '')));

            if (content.length > 100) {
                content = content.substring(0, 100) + '...';
            }

            return content.replace(/<\/?[^>]+(>|$)/g, "");
        },
    },
    mounted() {
        this.form.show(this.id);
    },
    template: html,
}