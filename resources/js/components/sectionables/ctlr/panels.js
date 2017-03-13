import shared from './shared';

// helpers
import Form from '../form';

// templates
import self from './panels';

// components (tabs)
import panelPreview from './panel-preview';
import panelContent from './panel-content';

import panels_html from '../templates/panels.html';

export default {
    mixins: [shared],
    data() {
        let panel = {
            section: this.section,
            form: new Form({shared: this.$parent.shared, section: this.section}),
        };
        return {
            panel: panel,
        }
    },
    beforeCreate: function () {
        this.$options.components.panels = self
    },
    components: {
        panelContent,
        panelPreview,
    },
    computed: {
        isActivePanel() {
            return this.section.id == this.shared.panel.active;
        },
    },
    methods: {
        setActivePanel() {
            this.shared.panel.active = this.section.id;
        },
    },
    template: panels_html
}