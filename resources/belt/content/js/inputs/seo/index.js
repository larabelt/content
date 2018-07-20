import html from 'belt/content/js/inputs/seo/template.html';

export default {
    props: {
        form: {
            default: function () {
                return this.$parent.form;
            }
        },
    },
    template: html
}