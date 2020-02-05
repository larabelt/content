import Table from 'belt/content/js/terms/table';
import parentTerms from 'belt/content/js/terms/ctlr/index-table';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import form_html from 'belt/content/js/terms/templates/form.html';

export default {
    mixins: [TranslationStore],
    data() {
        return {
            form: this.$parent.form,
            entity_id: this.$parent.entity_id,
            parentTerm: this.$parent.parentTerm,
            search: false,
            table: new Table({router: this.$router}),
        }
    },
    created() {
        this.bootTranslationStore();
    },
    destroyed() {
        this.form.reset();
    },
    methods: {
        toggle() {
            if (!this.search) {
                this.table.index();
            }
            this.search = !this.search;
        },
        clearParentTerm() {
            this.form.parent_id = null;
            this.parentTerm.reset();
            this.search = false;
        },
        submit() {
            Events.$emit('terms:' + this.entity_id + ':updating', this.form);
            this.form.submit();
        }
    },
    components: {
        parentTerms: {
            mixins: [parentTerms],
            methods: {
                confirm(term) {
                    if (term.id != this.$parent.form.parent_id) {
                        this.$parent.form.parent_id = term.id;
                        this.$parent.search = false;
                        this.$parent.parentTerm.setData(term);
                    }
                }
            }
        }
    },
    template: form_html,
}