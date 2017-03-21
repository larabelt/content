import shared from '../ctlr/shared';

// components
import Form from './form';

// templates
import html from './template.html';

export default {
    mixins: [shared],
    props: {
        param: {},
    },
    data() {
        return {
            dropdown: {},
            form: new Form(),
        }
    },
    computed: {
        show() {
           return this.form.key && this.dropdown;
        },
    },
    mounted() {
        this.form.service.baseUrl = `/api/v1/sections/${this.section.id}/params/`;
        this.form.show(this.param.id);

        let type = this.section.sectionable_type;
        let template = this.section.template;
        let key = this.param.key;

        this.dropdown = _.get(this.configs.data, `${type}.${template}.params.${key}`);

    },
    template: html,
}