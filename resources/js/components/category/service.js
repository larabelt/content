import BaseService from 'ohio/core/js/helpers/service';

class CategoryService extends BaseService {

    /**
     * Create a new Service instance.
     *
     * @param {object} options
     */
    constructor(options = {}) {
        super(options);
        this.baseUrl = '/api/v1/categories/';
    }

}

export default CategoryService;