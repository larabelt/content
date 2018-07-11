import list from 'belt/content/js/lists/store/mixin';
import edit from 'belt/content/js/lists/edit/shared';
import html from 'belt/content/js/lists/edit/form.html';
import priorityDropdown from 'belt/core/js/inputs/priority/form';
import templateDropdown from 'belt/content/js/templates/inputs/default';
import teamInput from 'belt/core/js/teams/input';

export default {
    mixins: [edit],
    components: {
        edit: {
            data() {
                return {
                    form: this.$parent.form,
                    list: this.$parent.list,
                    morphable_id: this.$parent.morphable_id,
                }
            },
            methods: {
                submit() {
                    Events.$emit('lists:' + this.morphable_id + ':updating', this.form);
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