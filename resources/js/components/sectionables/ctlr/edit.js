import shared from './shared';

import inner from './edit-inner';

// templates
import edit_html from '../templates/edit.html';

export default {
    mixins: [shared],
    components: {inner},
    methods: {
        save() {
            this.active.submit()
                .then(function () {
                    this.sections.index();
                });
        },
    },
    template: edit_html
}