window.$ = window.jQuery = require('jquery');

import form from 'ohio/core/js/mixins/base/forms';

export default {

    mixins: [form],

    data() {
        return {
            blocks: {
                url: '/api/v1/blocks/',
                saving: false,
                saved: false,
                errors: {},
                params: {},
                block: {},
                blocks: [],
            }
        }
    },

    methods: {
        submitBlock(event) {
            event.preventDefault();
            this.blocks.saving = true;
            this.blocks.saved = false;
            if (this.blocks.block.id) {
                return this.updateBlock(this.blocks.block);
            }
            return this.storeBlock(this.blocks.block);
        },
        paginateBlocks() {
            let url = this.blocks.url + '?' + $.param(this.getUrlParams());
            this.$http.get(url).then(function (response) {
                this.blocks.blocks = response.data.data;
            }, function (response) {
                console.log('error');
            });
        },
        getBlock() {
            this.$http.get(this.blocks.url + this.blocks.block.id).then((response) => {
                this.blocks.block = response.data;
            }, (response) => {

            });
        },
        updateBlock(params) {
            this.blocks.errors = {};
            this.$http.put(this.blocks.url + this.blocks.block.id, params).then((response) => {
                this.blocks.block = response.data;
                this.blocks.saved = true;
            }, (response) => {
                if (response.status == 422) {
                    this.blocks.errors = response.data.message;
                }
            });
            this.blocks.saving = false;
        },
        storeBlock(params) {
            this.blocks.errors = {};
            this.$http.post(this.blocks.url, params ).then((response) => {
                this.$router.push({ name: 'blockEdit', params: { id: response.data.id }})
            }, (response) => {
                if (response.status == 422) {
                    this.blocks.errors = response.data.message;
                }
            });
            this.blocks.saving = false;
        },
        destroyBlock(id) {
            this.$http.delete(this.blocks.url + id).then(function(response){
                if( response.status == 204 ) {
                    this.paginateBlocks();
                }
            });
        }
    }
};