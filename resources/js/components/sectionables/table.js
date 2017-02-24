import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';
import Form from './form';

class SectionTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        //let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/sections/`;
        //let baseUrl = `/api/v1/sections/?page_id=${this.morphable_id}`;
        let baseUrl = `/api/v1/sections/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.query.page_id = this.morphable_id;
    }

}

export default SectionTable;