import shared from 'belt/content/js/components/sectionables/ctlr/shared';

import inner from 'belt/content/js/components/sectionables/ctlr/edit-inner';

// templates
import edit_html from 'belt/content/js/components/sectionables/templates/edit.html';

export default {
    mixins: [shared],
    components: {inner},
    methods: {
        save() {
            this.active.submit()
                .then(() => {
                    this.sections.index();
                });
        },
    },
    template: edit_html
}