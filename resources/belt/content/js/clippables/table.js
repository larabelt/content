import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class AttachmentTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/${this.entity_type}/${this.entity_id}/attachments/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.query.perPage = 10;
    }

}

export default AttachmentTable;