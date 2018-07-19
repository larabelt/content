import shared from 'belt/content/js/attachments/ctlr/shared';
import thumb from 'belt/content/js/attachments/thumb';
import attachmentSummary from 'belt/content/js/attachments/summary';
import uploader from 'belt/content/js/base/uploader/ctlr';
import form_html from 'belt/content/js/attachments/templates/form.html';

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
            components: {
                attachmentSummary,
                thumb,
                uploader: {
                    mixins: [uploader],
                    methods: {
                        onUploadSuccess(attachment) {
                            this.$parent.form.show(attachment.id);
                        },
                    },
                },
            },
            template: form_html,
        },
    },
}