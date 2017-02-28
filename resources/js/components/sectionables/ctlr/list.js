import shared from './shared';

// templates
import self from './list';

import list_html from '../templates/list.html';

export default {
    mixins: [shared],
    beforeCreate: function () {
        this.$options.components.list = self
    },
    mounted() {
        if (!this.shared.panel.active) {
            this.shared.panel.active = this.section.id;
        }
    },
    computed: {
        isActivePanel() {
            return false;
        },
    },
    methods: {
        setActivePanel() {
            this.shared.panel.active = this.section.id;
        },
        drag(e) {
            this.shared.dragAndDrop.active = e.target.getAttribute('data-index');
        },
    },
    template: list_html
}