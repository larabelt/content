import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class BlockForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/blocks/'});
        this.routeEditName = 'blocks.edit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            heading: '',
            body: '',
        })
    }

}

export default BlockForm;