import shared from 'belt/content/js/sectionables/shared';
import panel from 'belt/content/js/sectionables/list/panel';
import Form from 'belt/content/js/sectionables/form';
import Table from 'belt/content/js/sectionables/table';
import html from 'belt/content/js/sectionables/list/template.html';

export default {
    mixins: [shared],
    data() {
        return {
            loading: false,
            moving: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            table: new Table({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
        }
    },
    computed: {
        first() {
            return _.head(this.sections);
        },
        sections() {
            return this.table.items;
        },
    },
    methods: {
        setMoving(section) {
            if (section) {
                this.moving.setData(section);
            } else {
                this.moving.reset();
            }
        }
    },
    mounted() {
        this.loading = true;
        this.table.index()
            .then(() => {
                this.loading = false;
            });
    },
    components: {panel},
    template: html,
}