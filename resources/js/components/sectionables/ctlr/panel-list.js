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
            dragAndDrop: this.$parent.dragAndDrop,
            config: this.$parent.config,
            panel: this.$parent.panel,
        }
    },
    beforeCreate: function () {
        this.$options.components.panelList = self
    },
    mounted() {
        if (!this.panel.active) {
            this.panel.active = this.section.id;
        }
    },
    methods: {
        setActive() {
            this.panel.active = this.section.id;
        },
        drag(e) {
            this.dragAndDrop.active = e.target.getAttribute('data-index');
        },
    },
    template: panelList_html
}