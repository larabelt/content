import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class ToutForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/touts/'});
        this.routeEditName = 'touts.edit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            body: '',
            heading: '',
            btn_text: '',
            btn_url: '',
        })
    }

}

export default ToutForm;