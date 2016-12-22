window.$ = window.jQuery = require('jquery');

import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    data() {
        return {
            pageTags: {
                status: null,
                tag: {},
                attached: [],
                detached: [],
                errors: {},
                params: {},
                meta: {},
            }
        }
    },

    methods: {
        searchPageTags() {
            if (this.pageTags.params.q) {
                this.listDetachedPageTags();
            } else {
                this.pageTags.detached = [];
            }
        },
        listAttachedPageTags() {

            let url = this.url + '?' + $.param(this.getParams());

            this.$http.get(url).then(function (response) {
                this.pageTags.attached = response.data.data;
            }, function (response) {
                console.log('error');
            });
        },
        listDetachedPageTags() {
            this.pageTags.detached = [];

            let url = this.url
                + '?not=1'
                + '&q=' + this.pageTags.params.q;

            this.$http.get(url).then(function (response) {
                this.pageTags.detached = response.data.data;
            }, function (response) {

            });

        },
        attachPageTag(id) {
            this.$http.post(this.url, {id: id}).then((response) => {
                if( response.status == 201 ) {
                    this.listAttachedPageTags();
                }
            }, (response) => {
            });
        },
        detachPageTag(id) {
            this.$http.delete(this.url + id).then(function(response){
                if( response.status == 204 ) {
                    this.listAttachedPageTags();
                }
            });
        }
    }
};