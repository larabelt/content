import shared from './panel-shared';

// templates
import panelPreview_html from '../templates/panel-preview.html';

export default {
    mixins: [shared],
    data() {
        let panel = this.$parent.panel;
        return {
            preview_url: '/sections/' + panel.section.id + '/preview'
        }
    },
    template: panelPreview_html
}