import tile from 'belt/core/js/tiles/default';
import html from 'belt/content/js/blocks/tiles/default/template.html';

export default {
    mixins: [tile],
    computed: {
        block() {
            return this.item;
        },
    },
    template: html,
}