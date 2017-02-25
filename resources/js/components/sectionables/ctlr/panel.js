// helpers
import Tabs from 'belt/core/js/helpers/tabs';

// components (tabs)
import panelList from './panel-list';
import panelEdit from './panel-edit';

// templates
import panel_html from '../templates/panel.html';

// config api / template dropdown

// customized item edit
// customized item add

// move section
// delete section
// add section

// one large panel
// style: separate section box-bodies...
// style: nicer tabs?

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