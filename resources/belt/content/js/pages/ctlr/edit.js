import shared from 'belt/content/js/pages/ctlr/shared';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import form_html from 'belt/content/js/pages/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            mixins: [TranslationStore],
            data() {
                return {
                    form: this.$parent.form,
                    entity_id: this.$parent.entity_id,
                }
            },
            created() {
                this.bootTranslationStore();
            },
            destroyed() {
                this.form.reset();
            },
            methods: {
                submit() {
                    Events.$emit('pages:' + this.entity_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            template: form_html,
        },
    },
}