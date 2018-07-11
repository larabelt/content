import BaseConfig from 'belt/core/js/helpers/config';
import BaseService from 'belt/core/js/helpers/service';

class TemplateConfig extends BaseConfig {

    constructor(options = {}) {
        super(options);
    }

    setService(key) {
        let baseUrl = '/api/v1/config/belt.templates/' + key;
        this.service = new BaseService({baseUrl: baseUrl});
    }

    options() {

        let templates = {};

        for (let key in this.data) {
            let config = this.data[key];
            templates[key] = config['label'] ? config['label'] : key;
        }

        return templates;
    }

}

export default TemplateConfig;