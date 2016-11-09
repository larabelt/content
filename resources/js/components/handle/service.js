window.$ = window.jQuery = require('jquery');
global._ = require('lodash');

import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    methods: {
        baseUrl() {
            return '/api/v1/handles/';
        },
        index() {

            let params = this.getParams();

            let url = this.baseUrl() + '?' + $.param(params);

            this.$http.get(url).then(function (response) {
                this.items = response.data;
            }, function (response) {
                console.log('error');
            });
        },
        get() {
            this.$http.get(this.baseUrl() + this.$parent.id).then((response) => {
                this.item = response.data;
            }, (response) => {

            });
        },
        put(params) {
            this.errors = {};
            this.$http.put(this.baseUrl() + params.id, params).then((response) => {
                this.item = response.data;
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

            let merged = _.merge(this.getParams(), params);

            this.$http.post(this.baseUrl(), merged).then((response) => {
                //this.$router.push({name: 'handleEdit', params: {id: response.data.id}})
                this.index()
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        },
        destroy(id) {
            this.$http.delete(this.baseUrl() + id).then(function (response) {
                if (response.status == 204) {
                    this.index();
                }
            });
        }
    }
};