// components
import shared from 'belt/content/js/handles/ctlr/shared';
import searchables from 'belt/content/js/searchables/ctrl';
import form_html from 'belt/content/js/handles/templates/form-edit.html';
import html from 'belt/content/js/handles/templates/edit.html';

export default {
    mixins: [shared],
    mounted() {
        this.form.show(this.$route.params.id);
    },
    components: {
        edit: {
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
                            this.form.target = this.form.target ? this.form.target : _.get(item, 'default_url');
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
    template: html,
}