// helpers
import Form from 'belt/content/js/terms/form';
import store from 'belt/content/js/terms/store';

// templates make a change

import tabs_html from 'belt/content/js/terms/templates/tabs.html';
import edit_html from 'belt/content/js/terms/templates/edit.html';

export default {
    data() {
        return {
            form: new Form(),
            parentTerm: new Form(),
            entity_type: 'terms',
            entity_id: this.$route.params.id,
        }
    },
    computed: {
        config() {
            return this.form.config;
        },
        sectionable() {
            return _.get(this.config, 'sectionable', false);
        },
        storeKey() {
            return 'terms' + this.entity_id;
        }
    },
    created() {
        this.form.setData({
            entity_type: this.entity_type,
            morph_class: this.entity_type,
            entity_id: this.entity_id,
            id: this.entity_id,
        });
        
        if (!this.$store.state[this.storeKey]) {
            this.$store.registerModule(this.storeKey, store);
            this.$store.dispatch(this.storeKey + '/construct', {id: this.entity_id});
        }
        this.form.show(this.entity_id)
            .then(() => {
                this.$store.dispatch(this.storeKey + '/load', this.form);
            });
    },
    components: {
        tabs: {template: tabs_html},
    },
    mounted() {
        this.form.show(this.entity_id)
            .then(() => {
                if (this.form.parent_id) {
                    this.parentTerm.show(this.form.parent_id);
                }
            });
    },
    template: edit_html,
}