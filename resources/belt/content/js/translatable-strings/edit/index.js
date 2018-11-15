import mixin from 'belt/content/js/translatable-strings/edit/mixin';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import form_html from 'belt/content/js/translatable-strings/edit/form.html';

export default {
    mixins: [mixin],
    components: {
        edit: {
            mixins: [TranslationStore],
            created() {
                this.bootTranslationStore();
            },
            computed: {
                form() {
                    return this.$parent.form;
                },
            },
            template: form_html,
        },
    },
}