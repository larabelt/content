// import columnSorter from '../../../../core/js/components/column-sorter';
// import pagination from '../../../../core/js/components/pagination';
import template from './templates/index';

export default {

    // components: {
    //     'column-sorter': columnSorter,
    //     'pagination': pagination
    // },

    template: template,

    data() {
        return {
            items: {
                uri: '/admin/ohio/content/pages',
                slug: 'pages',
                data: []
            }
        }
    },

    mounted() {
        this.getItems();
        console.log('pages');
        Vue.hello();
    },

    methods: {
        getItems() {
            let params = {};
            _(this.$route.query).forEach((value, key) => {
                params[key] = value;
            });

            let url = '/api/v1/pages?' + $.param(params);

            this.$http.get(url).then(function (response) {
                this.items.data = response.data;

            }, function (response) {
                console.log('Error');
            });
        },
        destroy(id) {
            this.$http.delete('/api/v1/pages/' + id).then(function(response){
                if( response.status == 204 ) {
                    this.getItems();
                }
            });
        }
    },

    watch: {
        '$route' (to, from) {
            this.getItems();
        }
    }
}