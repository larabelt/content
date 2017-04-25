// helpers
import Config from '../config';
import Form from '../form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';

export default {
    data() {
        return {
            form: new Form(),
            configurator: new Config(),
            configs: {},
        }
    },
    created() {
        this.configurator.load()
            .then((configs) => {
                this.configs = configs;
            });
    },
    components: {
        heading: {template: heading_html},
    },
}