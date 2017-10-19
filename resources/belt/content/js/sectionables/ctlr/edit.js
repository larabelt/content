import shared from 'belt/content/js/sectionables/ctlr/shared';
import store from 'belt/content/js/sectionables/store';
import inner from 'belt/content/js/sectionables/ctlr/edit-inner';
import edit_html from 'belt/content/js/sectionables/templates/edit.html';

export default {
    mixins: [shared],
    created() {
        if (!this.$store.state[this.storeActiveKey]) {
            this.$store.registerModule(this.storeActiveKey, store);
            this.$store.dispatch(this.storeActiveKey + '/construct', {id: this.active.id});
        }
        this.$store.dispatch(this.storeActiveKey + '/load', this.active);
        this.$store.dispatch(this.storeActiveKey + '/params/load');
    },
    components: {inner},
    methods: {
        // save() {
        //     this.active.submit()
        //         .then(() => {
        //             this.sections.index();
        //         });
        // },
        save: _.debounce(function () {
            this.active.submit()
                .then(() => {
                    this.sections.index();
                });
        }, 1000),
    },
    template: edit_html
}