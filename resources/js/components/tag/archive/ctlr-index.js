import headingTemplate from 'ohio/core/js/templates/base/heading';
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
                this.index();
            },
            watch: {
                '$route' (to, from) {
                    this.index();
                }
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