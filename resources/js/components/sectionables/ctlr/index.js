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

        let shared = {
            config: new Config(),
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
            panel: {
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
        };

        return {
            shared: shared,
            form: new Form({
                morphable_type: shared.morphable_type,
                morphable_id: shared.morphable_id,
            }),
        }
    },
    components: {
        list,
        panels,
        create,
    },
    created() {
        this.shared.table.index();
        this.shared.config.load();
    },
    mounted() {
        this.shared.tabs.tab = 'item';
    },
    methods: {
        drop(e) {
            let table = this.shared.table;
            let dragAndDrop = this.shared.dragAndDrop;
            if (dragAndDrop.dragging.id) {
                this.form.destroy(dragAndDrop.dragging.id)
                    .then(function () {
                        table.index();
                        dragAndDrop.dragging.id = false;
                        dragAndDrop.trashing = false;
                    });
            }
        },
    },
    template: index_html
}