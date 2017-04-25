import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class SearchTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/search/`;
        this.service = new BaseService({baseUrl: baseUrl});
    }

}

export default SearchTable;