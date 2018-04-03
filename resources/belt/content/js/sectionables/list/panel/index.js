import shared from 'belt/content/js/sectionables/shared';
import self from 'belt/content/js/sectionables/list/panel';
import html from 'belt/content/js/sectionables/list/panel/template.html';

export default {
    mixins: [shared],
    props: ['section'],
    beforeCreate: function () {
        this.$options.components.panel = self
    },
    components: {},
    created() {
        if (!this.first.id) {
            this.first.id = this.section.id;
        }
    },
    computed: {
        panelMode() {
            if (this.moving.id) {
                if (this.section.id == this.moving.id) {
                    return 'is-moving';
                }
                if (this.section._lft >= this.moving._lft && this.section._rgt <= this.moving._rgt) {
                    return 'is-along-for-the-ride';
                }
                return 'is-watching';
            }
            return 'default';
        },
        preview() {
            return _.get(this.section, 'preview');
        },
    },
    methods: {
        destroy(id) {
            let self = this;
            this.form.destroy(id)
                .then(function () {
                    self.sections.index();
                });
        },
        cancel() {
            this.reset();
        },
        insert(id, position) {
            this.creating.show = true;
            this.creating.neighbor_id = id;
            this.creating.position = position;
        },
        setMoving(id) {
            this.moving.show(id);
        },
    },
    template: html
}