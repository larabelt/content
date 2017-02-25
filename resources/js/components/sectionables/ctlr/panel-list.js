// templates
import self from './panel-list';

import panelList_html from '../templates/panel-list.html';

export default {
    props: {
        section: {},
    },
    computed: {
        isActive() {
            return this.section.id == this.panel.active;
        }
    },
    data() {
        return {
            panel: this.$parent.panel,
        }
    },
    beforeCreate: function () {
        this.$options.components.panelList = self
    },
    methods: {
        setActive() {
            this.panel.active = this.section.id;
        }
    },
    template: panelList_html
}