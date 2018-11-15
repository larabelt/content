import mixin from 'belt/content/js/translatable-strings/edit/mixin';
import storeMixin from 'belt/content/js/translatable-strings/edit/store/mixin';
import form_html from 'belt/content/js/translatable-strings/edit/form.html';

export default {
    mixins: [storeMixin, mixin],
    components: {
        edit: {
            computed: {
                form() {
                    return this.$parent.translatableString;
                },
            },
            template: form_html,
        },
    },
}