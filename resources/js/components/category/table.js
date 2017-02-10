import BaseTable from 'ohio/core/js/helpers/table';
import BaseService from 'ohio/core/js/helpers/service';

class CategoryTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/categories/'});
    }

}

export default CategoryTable;