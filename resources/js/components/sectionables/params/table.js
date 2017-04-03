import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class ParamTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/sections/${options.section.id}/params/`;
        this.service = new BaseService({baseUrl: baseUrl});
    }

}

export default ParamTable;