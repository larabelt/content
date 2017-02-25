// templates
import self from './panel-edit';

// components (tabs)
import editItem from './edit-item';
import editContent from './edit-content';
import editParams from './edit-params';

import panelEdit_html from '../templates/panel-edit.html';

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
            tabs: this.$parent.tabs,
        }
    },
    beforeCreate: function () {
        this.$options.components.panelEdit = self
    },
    components: {
        editContent,
        editItem,
        editParams,
    },
    template: panelEdit_html
}