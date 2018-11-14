import TranslationStore from 'belt/core/js/translations/store/adapter';
import edit from 'belt/content/js/lists/edit/shared';
import html from 'belt/content/js/lists/edit/form.html';

export default {
    mixins: [edit],
    components: {
        edit: {
            mixins: [TranslationStore],
            data() {
                return {
                    form: this.$parent.form,
                    list: this.$parent.list,
                    entity_id: this.$parent.entity_id,
                    entity_type: 'lists',
                }
            },
            created() {
                this.bootTranslationStore();
            },
            methods: {
                submit() {
                    Events.$emit('lists:' + this.entity_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            template: html,
        },
    },
}