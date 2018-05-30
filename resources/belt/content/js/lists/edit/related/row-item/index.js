import adminUrls from 'belt/core/js/mixins/admin-urls';
import html from 'belt/content/js/lists/edit/related/row-item/template.html';

export default {
    mixins: [adminUrls],
    props: {
        'item': {
            default: null,
        }
    },
    computed: {
        editUrl() {
            return this.adminEditUrl(this.item.id, this.item.listable_type);
            let beltPackage = 'core';
            let compiled = _.template('/admin/belt/${package}/${type}/edit/${id}');
            return compiled({
                package: beltPackage,
                type: this.item.listable_type,
                id: this.item.listable_id,
            });
        },
        id() {
            return this.item.id;
        },
        title() {
            return 'edit ' + this.type;
        },
        name() {
            return _.get(this.item, 'listable.name');
        },
        type() {
            return this.item.listable_type;
        },
    },
    template: html,
}