// helpers
import Tabs from 'belt/core/js/helpers/tabs';

// components (tabs)
import panelList from './panel-list';
import panelEdit from './panel-edit';

// templates
import panel_html from '../templates/panel.html';

// 1. config api / template drop-down

// customized item edit/add -> _blank links
// 5. customized item switch
// 3. customized item preview/show

// 2. delete section
// 4. add section
// move section

// embed to custom?
// section: header->heading?
// body: -> pre-item? and post-item (or similar)?

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