import TranslationStore from 'belt/core/js/translations/store/adapter';
import edit from 'belt/content/js/blocks/edit/shared';
import html from 'belt/content/js/blocks/edit/form.html';

export default {
    mixins: [edit],
    components: {
        edit: {
            mixins: [TranslationStore],
            data() {
                return {
                    form: this.$parent.form,
                    block: this.$parent.block,
                    entity_id: this.$parent.entity_id,
                    entity_type: 'blocks',
                }
            },
            created() {
                this.bootTranslationStore();
            },
            methods: {
                submit() {
                    Events.$emit('blocks:' + this.entity_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            template: html,
        },
    },
}