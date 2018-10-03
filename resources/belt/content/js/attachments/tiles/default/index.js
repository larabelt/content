import tile from 'belt/core/js/tiles/default';
import html from 'belt/spot/js/attachments/tiles/default/template.html';

export default {
    mixins: [tile],
    computed: {
        attachment() {
            return this.item;
        },
    },
    template: html,
}