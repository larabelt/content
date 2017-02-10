import BaseForm from 'ohio/core/js/helpers/form';
import BaseService from 'ohio/core/js/helpers/service';
import CategoryService from './service';

class CategoryForm extends BaseForm {

    /**
     * Create a new Form instance.
     *
     * @param {object} options
     */
    constructor(options = {}) {
        super(options);
        //this.service = new CategoryService();
        this.service = new BaseService({baseUrl: '/api/v1/categories/'});
        this.routeEditName = 'categoryEdit';
        this.setData({
            id: '',
            name: '',
            slug: '',
            body: '',
        })
    }

}

export default CategoryForm;