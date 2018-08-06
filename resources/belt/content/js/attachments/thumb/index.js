import html from 'belt/content/js/attachments/thumb/template.html';

export default {
    props: {
        attachment: {
            default: function () {
                return this.$parent.form;
            }
        },
        open_btn: {default: true},
    },
    computed: {
        icon() {

            let icon = _.get(this.attachment.config, 'icon');
            if (icon) {
                return icon;
            }

            if (this.attachment.is_image) {
                return 'fa-file-image-o';
            }
            if (this.type == 'video/youtube') {
                return 'fa-youtube';
            }
            if (this.type == 'video/vimeo') {
                return 'fa-vimeo';
            }
            if (this.attachment.is_video) {
                return 'fa-video-o';
            }
            if (this.type == 'pdf') {
                return 'fa-file-pdf-o';
            }
            return 'fa-file'
        },
        previewUrl() {
            if (this.attachment.preview_url) {
                return this.attachment.preview_url;
            }
            if (this.attachment.is_image) {
                return this.src;
            }
            return false;
        },
        src() {
            let thumb = _.find(this.attachment.resizes, {preset: 'thumb'});
            return thumb ? thumb.src : this.attachment.src;
        },
        title() {
            return this.attachment.title ? this.attachment.title : this.attachment.name;
        },
        type() {

            let label = _.get(this.attachment.config, 'label');
            if (label) {
                return label;
            }

            let mimetype = this.attachment.mimetype;

            if (mimetype == 'application/pdf') {
                return 'pdf';
            }

            if (mimetype == 'application/vnd.openxmlformats-officedocument.word') {
                return 'ms-office/word';
            }

            if (mimetype == 'application/vnd.openxmlformats-officedocument.spre') {
                return 'ms-office/excel';
            }

            return mimetype;
        },
    },
    template: html,
}