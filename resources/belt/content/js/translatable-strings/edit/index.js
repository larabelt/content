import mixin from 'belt/content/js/translatable-strings/edit/mixin';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import form_html from 'belt/content/js/translatable-strings/edit/form.html';

export default {
    mixins: [mixin],
    components: {
        edit: {
            mixins: [TranslationStore],
            data() {
                return {
                    entity_type: 'translatable_strings',
                    entity_id: this.$parent.entity_id,
                }
            },
            created() {
                this.bootTranslationStore();
            },
            computed: {
                form() {
                    return this.$parent.form;
                },
            },
            methods: {
                submit() {
                    Events.$emit('translatable_strings:' + this.entity_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            template: form_html,
        },
    },
}