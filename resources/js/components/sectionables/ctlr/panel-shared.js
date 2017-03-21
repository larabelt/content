import shared from './shared';

export default {
    mixins: [shared],
    data() {
        let panel = this.$parent.panel;
        return {
            panel: panel,
        }
    },
    // computed: {},
    // methods: {},
}