import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class PageForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/pages/'});
        this.routeEditName = 'pageEdit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            body: '',
        })
    }

}

export default PageForm;