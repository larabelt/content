import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class ListForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/lists/'});
        this.routeEditName = 'lists.edit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            rating: '',
            heading: '',
            body: '',
            meta_title: '',
            meta_keywords: '',
            meta_description: '',
            template: '',
            priority: 0,
        })
    }

}

export default ListForm;