import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    data() {
        return {
            url: '/api/v1/handles/',
            handleable_type: '',
            handleable_id: null,
        }
    },
    methods: {
        paginate(query) {
            this.query = _.merge(this.query, query);
            this.query = _.merge(this.query, {
                handleable_type: this.handleable_type,
                handleable_id: this.handleable_id,
            });
            let url = this.url + '?' + $.param(this.query);
            this.$http.get(url).then(function (response) {
                this.items = response.data.data;
                this.paginator = this.setPaginator(response);
            }, function (response) {

            });
        },
        store(params) {
            this.errors = {};
            params = _.merge(params, {
                handleable_type: this.handleable_type,
                handleable_id: this.handleable_id,
            });
            this.$http.post(this.url, params).then((response) => {
                this.item = {};
                this.paginate();
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        },
        destroy(id) {
            this.$http.delete(this.url + id).then(function (response) {
                if (response.status == 204) {
                    this.paginate();
                }
            });
        }
    }
};