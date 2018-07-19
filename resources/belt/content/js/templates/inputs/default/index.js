import Config from 'belt/content/js/templates/config';
import html from 'belt/content/js/templates/inputs/default/dropdown.html';

export default {
    props: {
        autoset: {
            default: function () {
                return false;
            }
        },
        formKey: {
            default: function () {
                return 'form';
            }
        },
        templateType: {
            default: function () {
                return this.$parent.entity_type;
            }
        },
    },
    data() {

        // set form
        let formKey = this.formKey ? this.formKey : 'form';
        let form = this.$parent[formKey];

        return {
            config: new Config(),
            dropdown: {},
            form: form,
        }
    },
    created() {
        this.config.setService(this.type);
        this.config.load()
            .then((response) => {
                this.dropdown = this.config.options();
                if (this.autoset) {
                    this.form.template = this.defaultTemplate;
                }
            });
    },
    computed: {
        defaultTemplate() {
            return _.keys(this.dropdown)[0];
        },
        type() {
            return this.templateType ? this.templateType : this.$parent.entity_type;
        }
    },
    template: html
}