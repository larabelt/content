import BaseConfig from 'belt/core/js/helpers/config';
import BaseService from 'belt/core/js/helpers/service';

class TemplateConfig extends BaseConfig {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: `/api/v1/config/belt.templates/`});
    }

    dropdown(type) {

        let templates = {};

        for (let key in this.data[type]) {
            let config = this.data[type][key];
            templates[key] = config['label'] ? config['label'] : key;
        }

        return templates;
    }

}

export default TemplateConfig;