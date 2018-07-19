import Form from 'belt/content/js/pages/form';
import store from 'belt/content/js/pages/store';

import tabs_html from 'belt/content/js/pages/templates/tabs.html';
import edit_html from 'belt/content/js/pages/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            entity_type: 'pages',
            entity_id: this.$route.params.id,
        }
    },
    created() {
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.entity_id});
        }
        this.form.show(this.entity_id)
            .then(() => {
                this.$store.dispatch(this.storeKey + '/load', this.form);
            });
    },
    computed: {
        config() {
            return this.form.config;
            //return this.$store.getters[this.storeKey + '/config/data'];
        },
        sectionable() {
            return _.get(this.config, 'sectionable', false);
        },
        storeKey() {
            return 'pages' + this.entity_id;
        },
    },
    components: {
        tabs: {template: tabs_html},
    },
    template: edit_html,
}