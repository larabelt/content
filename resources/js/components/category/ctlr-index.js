import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import categoryService from './service0';
import categoryIndexTemplate from './templates/index.html';

export default {

    components: {
        'heading': {
            data() {
                return {
                    title: 'Category Manager',
                    subtitle: '',
                    crumbs: []
                }
            },
            template: headingTemplate
        },
        'category-index': {
            mixins: [categoryService],
            template: categoryIndexTemplate,
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
                <category-index></category-index>
            </section>
        </div>
        `
}