import Config from 'belt/content/js/templates/config';

export default {
    props: {
        templateType: {
            default: function () {
                return this.$parent.morphable_type;
            }
        },
    },
    data() {
        return {
            config: new Config(),
            options: {},
        }
    },
    created() {
        this.config.setService(this.type);
        this.config.load()
            .then(() => {
                this.options = this.config.options();
            });
    },
    computed: {
        defaultTemplate() {
            return _.keys(this.options)[0];
        },
        type() {
            return this.templateType ? this.templateType : this.$parent.morphable_type;
        },
    },
}