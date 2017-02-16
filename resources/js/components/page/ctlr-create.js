import headingTemplate from 'belt/core/js/templates/heading2.html';
import createTemplate from './templates/create.html';
import formTemplate from './templates/form.html';
import PageForm from './form';

export default {
    components: {
        heading: { template: headingTemplate },
        pageForm: {
            data() {
                return {
                    form: new PageForm({router: this.$router}),
                }
            },
            template: formTemplate,
        },
    },
    template: createTemplate
}