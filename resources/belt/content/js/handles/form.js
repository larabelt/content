import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class HandleForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/handles/'});
        this.routeEditName = 'handles.edit';
        this.setData({
            id: '',
            handleable_id: '',
            handleable_type: '',
            subtype: 'not-found',
            is_active: 1,
            is_default: 0,
            url: '',
            target: '',
        })
    }
}

export default HandleForm;