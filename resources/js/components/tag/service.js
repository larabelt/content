window.$ = window.jQuery = require('jquery');

import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    data() {
        return {
            tags: {
                tag: {},
                tags: [],
                url: '/api/v1/tags/',
                errors: {},
                paginator: {},
                params: {},
                saved: false,
                saving: false,
            }
        }
    },

    methods: {
        submitTag(event) {
            event.preventDefault();
            this.tags.saving = true;
            this.tags.saved = false;
            if (this.tags.tag.id) {
                return this.updateTag(this.tags.tag);
            }
            return this.storeTag(this.tags.tag);
        },
        paginateTags() {
            let url = this.tags.url + '?' + $.param(this.getUrlParams());
            this.$http.get(url).then(function (response) {
                this.tags.tags = response.data.data;
                this.tags.paginator = this.getPaginatorData(response);
            }, function (response) {
                console.log('error');
            });
        },
        getTag() {
            this.$http.get(this.tags.url + this.tags.tag.id).then((response) => {
                this.tags.tag = response.data;
            }, (response) => {

            });
        },
        updateTag(params) {
            this.tags.errors = {};
            this.$http.put(this.tags.url + this.tags.tag.id, params).then((response) => {
                this.tags.tag = response.data;
                this.tags.saved = true;
            }, (response) => {
                if (response.status == 422) {
                    this.tags.errors = response.data.message;
                }
            });
            this.tags.saving = false;
        },
        storeTag(params) {
            this.tags.errors = {};
            this.$http.post(this.tags.url, params ).then((response) => {
                this.$router.push({ name: 'tagEdit', params: { id: response.data.id }})
            }, (response) => {
                if (response.status == 422) {
                    this.tags.errors = response.data.message;
                }
            });
            this.tags.saving = false;
        },
        destroyTag(id) {
            this.$http.delete(this.tags.url + id).then(function(response){
                if( response.status == 204 ) {
                    this.paginateTags();
                }
            });
        }
    }
};