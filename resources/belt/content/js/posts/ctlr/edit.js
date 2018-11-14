import shared from 'belt/content/js/posts/ctlr/shared';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import form_html from 'belt/content/js/posts/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            mixins: [TranslationStore],
            data() {
                return {
                    form: this.$parent.form,
                    entity_id: this.$parent.entity_id,
                    entity_type: 'posts',
                }
            },
            created() {
                this.bootTranslationStore();
            },
            template: form_html,
        },
    },
}