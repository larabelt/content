import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class TermForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/terms/'});
        this.routeEditName = 'terms.edit';
        this.setData({
            id: '',
            parent_id: null,
            is_active: 0,
            name: '',
            slug: '',
            body: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
            full_name: '',
            subtype: '',
        })
    }

}

export default TermForm;