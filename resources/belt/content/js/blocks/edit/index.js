import block from 'belt/content/js/blocks/store/mixin';
import edit from 'belt/content/js/blocks/edit/shared';
import html from 'belt/content/js/blocks/edit/form.html';
import priorityDropdown from 'belt/core/js/inputs/priority/form';
import templateDropdown from 'belt/content/js/templates';
import teamInput from 'belt/core/js/teams/input';

export default {
    mixins: [edit],
    components: {
        edit: {
            data() {
                return {
                    form: this.$parent.form,
                    block: this.$parent.block,
                    morphable_id: this.$parent.morphable_id,
                }
            },
            methods: {
                submit() {
                    Events.$emit('blocks:' + this.morphable_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            components: {
                priorityDropdown,
                templateDropdown,
                teamInput,
            },
            template: html,
        },
    },
}