// components
import edit from 'belt/spot/js/listables/ctlr/edit';
import panel from 'belt/spot/js/listables/ctlr/panel';

// helpers
import Form from 'belt/spot/js/listables/form';
import Table from 'belt/spot/js/listables/table';
import PlaceTable from 'belt/spot/js/listables/../places/table';

// templates
import index_html from 'belt/spot/js/listables/templates/index.html';

export default {
    data() {
        return {
            morphable_id: this.$parent.morphable_id,
            active: new Form({
                morphable_id: this.$parent.morphable_id,
            }),
            form: new Form({
                morphable_id: this.$parent.morphable_id,
            }),
            listables: new Table({
                morphable_id: this.$parent.morphable_id,
            }),
            places: new PlaceTable(),
            modes: {
                active: 'index',
            },
            moving: new Form({
                morphable_id: this.$parent.morphable_id,
            }),
            scroll: {x: 0, y: 0},
        }
    },
    created() {
        this.listables.index();
    },
    mounted() {
        let listable_id = this.$route.params.place;
        if (listable_id) {
            this.modes.active = 'edit';
            this.active.show(listable_id);
        }
    },
    components: {edit, panel},
    computed: {
        mode() {
            return this.modes.active;
        }
    },
    methods: {
        attach(place_id) {
            this.form.setData({
                itinerary_id: this.morphable_id,
                place_id: place_id,
            });
            this.form.store()
                .then(() => {
                    this.listables.index();
                    this.places.query.q = '';
                })
        },
        clearPlaces() {
            this.places.query.q = '';
        },
    },
    template: index_html
}