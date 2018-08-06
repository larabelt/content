import shared from 'belt/content/js/clippables/shared';
import thumb from 'belt/content/js/attachments/thumb';
import html from 'belt/content/js/clippables/list-item/template.html';

export default {
    mixins: [shared],
    props: {
        attachment: {
            default: function () {
                //return this.$parent.attachment;
            }
        },
    },
    components: {
        thumb
    },
    computed: {
        highlighted() {

            let id = this.attachment.id;
            if (id) {
                let data = this.$store.getters['highlighted/data'];
                return data.hasOwnProperty(id);
            }

            return false;
        },
        name() {
            return this.attachment.original_name ? this.attachment.original_name : name;
        }
    },
    methods: {
        cancel() {
            this.$store.dispatch('clippable/active', {});
            this.$store.dispatch('clippable/set', {mode: 'list'});
        },
        highlight(attachment) {
            this.$store.dispatch('highlighted/toggle', attachment);
        },
        move(target, type) {
            this.$store.dispatch('clippable/move', {target: target, type: type})
                .then(() => {
                    this.$store.dispatch('clippable/load');
                    this.cancel();
                });
        },
        setMoving(attachment) {
            this.$store.dispatch('clippable/active', attachment);
            this.$store.dispatch('clippable/set', {mode: 'moving'});
        },
    },
    template: html,
};