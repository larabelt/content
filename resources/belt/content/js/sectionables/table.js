import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class SectionTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/sections/`;
        this.service = new BaseService({baseUrl: baseUrl});
    }

}

export default SectionTable;