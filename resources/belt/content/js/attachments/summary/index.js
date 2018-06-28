import html from 'belt/content/js/attachments/summary/template.html';

export default {
    props: {
        attachment: {default: function() {
            return this.$parent.form;
        }},
    },
    template: html,
}