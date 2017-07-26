import shared from 'belt/content/js/components/touts/ctlr/shared';

// components
import attachment from 'belt/clip/js/components/clippables/ctlr/attachment';

// helpers
import Form from 'belt/content/js/components/touts/form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import tabs_html from 'belt/content/js/components/touts/templates/tabs.html';
import edit_html from 'belt/content/js/components/touts/templates/edit.html';
import form_html from 'belt/content/js/components/touts/templates/form.html';

export default {
    data() {
        return {
            morphable_type: 'touts',
            morphable_id: this.$route.params.id,
            tout: new Form(),
        }
    },
    mounted() {
        this.tout.show(this.morphable_id);
    },
    components: {
        heading: {template: heading_html},
        tabs: {template: tabs_html},
        tab: {
            mixins: [shared],
            components: {attachment},
            template: form_html,
        },
    },
    template: edit_html,
}