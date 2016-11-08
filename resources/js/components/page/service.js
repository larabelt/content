export default {
    methods: {
        index() {

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
        get() {
            this.$http.get('/api/v1/pages/' + this.$parent.id).then((response) => {
                this.page = this.$parent.page = response.data;
            }, (response) => {

            });
        },
        put(params) {
            this.errors = {};
            this.$http.put('/api/v1/pages/' + params.id, params).then((response) => {
                this.page = this.$parent.page = response.data;
                this.saved = true;
                this.$parent.msg = 'saved'; //test
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        },
        post(params) {
            this.errors = {};
            this.$http.post('/api/v1/pages', params ).then((response) => {
                this.$router.push({ name: 'pageEdit', params: { id: response.data.id }})
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        },
        destroy(id) {
            this.$http.delete('/api/v1/pages/' + id).then(function(response){
                if( response.status == 204 ) {
                    this.index();
                }
            });
        }
    }
};