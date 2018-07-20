import BaseConfig from 'belt/core/js/helpers/config';
import BaseService from 'belt/core/js/helpers/service';

class TemplateConfig extends BaseConfig {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: `/api/v1/config/belt.subtypes.handles/`});
    }

}

export default TemplateConfig;