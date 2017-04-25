// components
import searchables from 'belt/content/js/components/searchables/ctrl';
import shared from './shared';

import edit_html from '../templates/edit.html';
import form_html from '../templates/form-edit.html';

export default {
    mixins: [shared],
    mounted() {
        this.form.show(this.$route.params.id);
    },
    components: {
        tab: {
            data() {
                return {
                    configurator: this.$parent.configurator,
                    configs: this.$parent.configs,
                    form: this.$parent.form,
                }
            },
            computed: {
                config() {
                    return _.get(this.configs, this.form.config_name);
                },
            },
            components: {
                searchables: {
                    mixins: [searchables],
                    data() {
                        return {
                            form: this.$parent.form,
                        }
                    },
                    created() {
                        this.item = this.form.handleable ? this.form.handleable : {};
                    },
                    methods: {
                        attach(item) {
                            this.item = item;
                            this.form.handleable_type = item.morph_class;
                            this.form.handleable_id = item.id;
                            this.table.query.q = null;
                            this.table.items = [];
                        },
                        clear() {
                            this.item = {};
                            this.form.handleable_type = null;
                            this.form.handleable_id = null;
                            this.table.query.q = null;
                            this.table.items = [];
                        },
                    }
                }
            },
            template: form_html,
        },
    },
    template: edit_html,
}