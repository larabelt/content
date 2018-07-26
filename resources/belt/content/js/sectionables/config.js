import BaseConfig from 'belt/core/js/helpers/config';
import BaseService from 'belt/core/js/helpers/service';

class SubtypeConfig extends BaseConfig {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: `/api/v1/config/belt.subtypes/`});
    }

    dropdown(type) {

        let subtypes = {};

        for (let key in this.data[type]) {
            let config = this.data[type][key];
            subtypes[key] = config['label'] ? config['label'] : key;
        }

        return subtypes;
    }

}

export default SubtypeConfig;