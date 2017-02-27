// helpers
import Tabs from 'belt/core/js/helpers/tabs';

// components (tabs)
import panelList from './panel-list';
import panelEdit from './panel-edit';

// templates
import panel_html from '../templates/panel.html';

export default {
    props: {
        section: {},
    },
    data() {
        return {
            panel: {
                active: this.section.id,
            },
            tabs: new Tabs({
                router: this.$router,
                toggleable: true,
            }),
        }
    },
    mounted() {
        this.tabs.tab = 'item';
        this.panel.active = this.section.id;
    },
    components: {
        panelList,
        panelEdit,
    },
    template: panel_html
}