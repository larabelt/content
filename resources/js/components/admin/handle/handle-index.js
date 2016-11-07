import columnSorter from 'ohio/core/js/components/base/column-sorter';
import pagination from 'ohio/core/js/components/base/pagination';
import template from './templates/index2';

export default {

    components: {
        'column-sorter': columnSorter,
        'pagination': pagination,
    },

    template: template,

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