import shared from 'belt/content/js/pages/ctlr/shared';

import form_html from 'belt/content/js/pages/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    form: this.$parent.form,
                    entity_id: this.$parent.entity_id,
                }
            },
            methods: {
                submit() {
                    Events.$emit('pages:' + this.entity_id + ':updating', this.form);
                    this.form.submit();
                }
            },
            components: {

            },
            template: form_html,
        },
    },
}