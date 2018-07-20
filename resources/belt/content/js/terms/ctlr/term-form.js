import Table from 'belt/content/js/terms/table';
import templateDropdown from 'belt/content/js/subtypes/inputs/default';
import parentTerms from 'belt/content/js/terms/ctlr/index-table';
import form_html from 'belt/content/js/terms/templates/form.html';

export default {
    data() {
        return {
            form: this.$parent.form,
            parentTerm: this.$parent.parentTerm,
            search: false,
            table: new Table({router: this.$router}),
        }
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
        }
    },
    components: {
        templateDropdown,
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