import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class ItineraryTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/itineraries/${this.morphable_id}/places/`;
        this.service = new BaseService({baseUrl: baseUrl});
    }

}

export default ItineraryTable;