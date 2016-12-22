window.$ = window.jQuery = require('jquery');

import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    data() {
        return {
            pages: {
                page: {},
                pages: [],
                url: '/api/v1/pages/',
                errors: {},
                paginator: {},
                params: {},
                saved: false,
                saving: false,
            }
        }
    },

    methods: {
        submitPage(event) {
            event.preventDefault();
            this.pages.saving = true;
            this.pages.saved = false;
            if (this.pages.page.id) {
                return this.updatePage(this.pages.page);
            }
            return this.storePage(this.pages.page);
        },
        paginatePages() {
            let url = this.pages.url + '?' + $.param(this.getUrlParams());
            this.$http.get(url).then(function (response) {
                this.pages.pages = response.data.data;
                this.pages.paginator = this.getPaginatorData(response);
            }, function (response) {
                console.log('error');
            });
        },
        getPage() {
            this.$http.get(this.pages.url + this.pages.page.id).then((response) => {
                this.pages.page = response.data;
            }, (response) => {

            });
        },
        updatePage(params) {
            this.pages.errors = {};
            this.$http.put(this.pages.url + this.pages.page.id, params).then((response) => {
                this.pages.page = response.data;
                this.pages.saved = true;
            }, (response) => {
                if (response.status == 422) {
                    this.pages.errors = response.data.message;
                }
            });
            this.pages.saving = false;
        },
        storePage(params) {
            this.pages.errors = {};
            this.$http.post(this.pages.url, params ).then((response) => {
                this.$router.push({ name: 'pageEdit', params: { id: response.data.id }})
            }, (response) => {
                if (response.status == 422) {
                    this.pages.errors = response.data.message;
                }
            });
            this.pages.saving = false;
        },
        destroyPage(id) {
            this.$http.delete(this.pages.url + id).then(function(response){
                if( response.status == 204 ) {
                    this.paginatePages();
                }
            });
        }
    }
};