import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import pageService from './service';
import pageIndexTemplate from './templates/index';

export default {

    components: {
        'heading': {
            data() {
                return {
                    title: 'Page Manager',
                    subtitle: '',
                    crumbs: [],
                }
            },
            'template': headingTemplate
        },
        'page-index': {
            mixins: [pageService],
            template: pageIndexTemplate,
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
                <page-index></page-index>
            </section>
        </div>
        `
}