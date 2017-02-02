import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import tagService from './service';
import tagIndexTemplate from './templates/index';

export default {

    components: {
        'heading': {
            data() {
                return {
                    title: 'Tag Manager',
                    subtitle: '',
                    crumbs: [],
                }
            },
            'template': headingTemplate
        },
        'tag-index': {
            mixins: [tagService],
            template: tagIndexTemplate,
            mounted() {
                this.query = this.getUrlQuery();
                this.paginate();
            },
        },
    },

    template: `
        <div>
            <heading></heading>
            <section class="content">
                <tag-index></tag-index>
            </section>
        </div>
        `
}