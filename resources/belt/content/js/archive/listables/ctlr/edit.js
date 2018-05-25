import shared from 'belt/content/js/listables/ctlr/shared';

// templates
import edit_html from 'belt/content/js/listables/templates/edit.html';

export default {
    mixins: [shared],
    methods: {
        save() {
            this.active.submit()
                .then(() => {
                    this.listables.index();
                });
        },
    },
    template: edit_html
}