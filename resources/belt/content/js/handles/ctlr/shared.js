// helpers
import Config from 'belt/content/js/handles/config';
import Form from 'belt/content/js/handles/form';

// templates make a change


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

    },
}