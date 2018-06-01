import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class Table extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/lists/${this.morphable_id}/items/`;
        this.service = new BaseService({baseUrl: baseUrl});
    }

}

export default Table;