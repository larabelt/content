import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class HandleTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/handles/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.query.orderBy = '-handles.is_default';
        this.query.sortBy = null;
    }

}

export default HandleTable;