import panel from 'belt/content/js/sectionables/list/panel';
import Form from 'belt/content/js/sectionables/form';
import Table from 'belt/content/js/sectionables/table';
import html from 'belt/content/js/sectionables/list/template.html';

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
    mounted() {
        this.sections.index();
    },
    methods: {
        insert() {
            this.creating.show = true;
        },
    },
    components: {panel},
    template: html,
}