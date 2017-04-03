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
        return {
            panel: {
                section: this.section,
                form: new Form({
                    section: this.section,
                    morphable_id: this.$parent.morphable_id,
                    morphable_type: this.$parent.morphable_type,
                }),
            },
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
            return this.section.id == this.panels.active;
        },
    },
    methods: {
        setActivePanel() {
            this.panels.active = this.section.id;
        },
    },
    template: panels_html
}