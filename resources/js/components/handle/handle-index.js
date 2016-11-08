import columnSorter from 'ohio/core/js/components/base/column-sorter';
import pagination from 'ohio/core/js/components/base/pagination';
import template from './templates/index';
import service from './service';

export default {

    mixins: [service],

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


    },

    watch: {
        '$route' (to, from) {
            this.index();
        }
    }
}