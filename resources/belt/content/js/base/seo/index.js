import html from 'belt/content/js/base/seo/template.html';

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