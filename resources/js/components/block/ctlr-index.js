import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import blockService from './service';
import blockIndexTemplate from './templates/index';

export default {

    components: {
        'heading': {
            data() {
                return {
                    title: 'Block Manager',
                    subtitle: '',
                    crumbs: [],
                }
            },
            'template': headingTemplate
        },
        'block-index': {
            mixins: [blockService],
            template: blockIndexTemplate,
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
                <block-index></block-index>
            </section>
        </div>
        `
}