// components
import create from 'belt/content/js/sectionables/ctlr/create';
import edit from 'belt/content/js/sectionables/ctlr/edit';
import panel from 'belt/content/js/sectionables/ctlr/panel';

// helpers
import Config from 'belt/content/js/sectionables/config';
import Form from 'belt/content/js/sectionables/form';
import Table from 'belt/content/js/sectionables/table';

// templates
import index_html from 'belt/content/js/sectionables/templates/index.html';

export default {
    data() {
        return {
            active: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            creating: {
                show: false,
                neighbor_id: null,
                position: null,
            },
            moving: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            configurator: new Config(),
            configs: {},
            first: {id: null},
            morphable_type: this.$parent.morphable_type,
            morphable_id: this.$parent.morphable_id,
            sections: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            scroll: {x: 0, y: 0},
        }
    },
    created() {
        this.configurator.load()
            .then((response) => {
                this.configs = response;
                this.sections.index();
            });
    },
    mounted() {
        let section_id = this.$route.params.section;
        if (section_id) {
            this.active.show(section_id);
        }
    },
    components: {create, edit, panel},
    computed: {
        mode() {
            if (this.active.id) {
                return 'edit';
            }
            if (this.creating.show == true) {
                return 'create';
            }
            return 'index';
        }
    },
    methods: {
        insert() {
            this.creating.show = true;
        },
    },
    template: index_html
}