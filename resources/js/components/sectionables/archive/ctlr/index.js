// components
import list from './list';
import panels from './panels';
import create from './create';

// helpers
import Form from '../form';
import Table from '../table';
import Tabs from 'belt/core/js/helpers/tabs';
import Config from '../config';

// templates
import index_html from '../templates/index.html';

export default {
    data() {
        return {
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            configs: new Config(),
            morphable_type: this.$parent.morphable_type,
            morphable_id: this.$parent.morphable_id,
            dragAndDrop: {
                active: '',
                position: '',
                trashing: '',
                dragging: {
                    id: '',
                    type: '',
                },
                dropping: {
                    id: '',
                    position: '',
                },
            },
            panels: {
                active: '',
            },
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            tabs: new Tabs({
                router: this.$router,
                toggleable: true,
            }),
        }
    },
    components: {
        list,
        panels,
        create,
    },
    created() {
        this.table.index();
        this.configs.load();
    },
    mounted() {
        this.tabs.tab = 'content';
    },
    template: index_html
}