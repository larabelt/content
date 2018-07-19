// components
import uploader from 'belt/content/js/base/uploader/ctlr';

// helpers
import Form from 'belt/content/js/attachments/form';

// templates
import attachment_html from 'belt/content/js/clippables/templates/attachment.html';
import uploader_html from 'belt/content/js/base/uploader/template.html';

export default {
    props: {
        owner: {},
        path: {default: ''},
        driver: {default: ''},
    },
    data() {
        return {
            attachment: new Form(),
            entity_type: this.$parent.entity_type,
            entity_id: this.$parent.entity_id,
        }
    },
    mounted() {
        if (this.owner.attachment_id) {
            this.attachment.show(this.owner.attachment_id);
        }
    },
    components: {
        uploader: {
            mixins: [uploader],
            data() {
                return {
                    attachment: this.$parent.attachment,
                    owner: this.$parent.owner,
                }
            },
            methods: {
                onUploadSuccess(response) {
                    let attachment = this.attachment;
                    this.owner.attachment_id = response.id;
                    this.owner.submit()
                        .then(function () {
                            attachment.show(response.id);
                        });
                },
                attach(id) {
                    let attachment = this.attachment;
                    this.owner.attachment_id = id;
                    this.owner.submit()
                        .then(function () {
                            attachment.show(id)
                                .then(function () {
                                });
                        });
                },
            },
            template: uploader_html
        },
    },
    methods: {
        detach() {
            let attachment = this.attachment;
            this.owner.attachment_id = '';
            this.owner.submit()
                .then(function () {
                    attachment.reset();
                });
        }
    },
    template: attachment_html
}