import heading from 'ohio/core/js/components/base/heading';
import handleIndex from './handle-index';

export default {

    components: {
        'heading': heading,
        'handle-index': handleIndex,
    },

    template: `
        <div>
            <heading 
                title="Handle Manager" 
                ></heading>
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
    },

    mounted() {
        this.index();
        Vue.hello();
    },

    methods: {
        index() {

            let params = {};
            _(this.$route.query).forEach((value, key) => {
                params[key] = value;
            });

            let url = '/api/v1/handles?' + $.param(params);

            this.$http.get(url).then(function (response) {
                this.items.data = response.data;

            }, function (response) {
                console.log('Error');
            });
        },
        destroy(id) {
            this.$http.delete('/api/v1/handles/' + id).then(function(response){
                if( response.status == 204 ) {
                    this.index();
                }
            });
        }
    },

    watch: {
        '$route' (to, from) {
            this.index();
        }
    }
}