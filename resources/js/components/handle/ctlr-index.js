import heading from 'ohio/core/js/components/base/heading';
import handleIndex from './handle-index';

export default {

    components: {
        'heading': heading,
        'handle-index': handleIndex,
    },

    template: `
        <div>
            <heading title="Handle Manager"></heading>
            <handle-index></handle-index>
        </div>
    `,

    data() {
        return {
            items: {
                uri: '/admin/ohio/content/handles',
                slug: 'handles',
                data: []
            }
        }
    }
}