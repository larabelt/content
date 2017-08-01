import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class HandleTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/handles/'});
        this.query.is_active = null;
        this.query.orderBy = '-handles.id';
        this.query.sortBy = null;
    }

}

export default HandleTable;