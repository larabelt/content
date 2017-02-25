// components
import panel from './panel';
import panelList from './panel-list';
import panelEdit from './panel-edit';

// helpers
//import Form from '../form';
import Table from '../table';
import Tabs from 'belt/core/js/helpers/tabs';

// templates
import index_html from '../templates/index.html';

export default {
    data() {
        return {
            // form: new Form({
            //     morphable_type: this.$parent.morphable_type,
            //     morphable_id: this.$parent.morphable_id,
            // }),
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            panel: {
                //active: this.section.id,
                active: '',
            },
            tabs: new Tabs({
                router: this.$router,
                toggleable: true,
            }),
        }
    },
    mounted() {
        this.tabs.tab = 'item';
        //this.panel.active = this.section.id;
    },
    components: {
        panel,
        panelList,
        panelEdit,
    },
    created() {
        this.table.index();
    },
    template: index_html
}