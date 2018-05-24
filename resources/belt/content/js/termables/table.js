import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class TermTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/terms/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.query.perPage = 10;
    }

}

export default TermTable;