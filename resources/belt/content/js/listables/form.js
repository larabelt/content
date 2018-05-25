import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class Form extends BaseForm {

    /**
     * Create a new Form instance.
     *
     * @param {object} options
     */
    constructor(options = {}) {
        super(options);
        let baseUrl = `/api/v1/itineraries/${this.morphable_id}/places/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.setData({
            id: '',
            itinerary_id: '',
            place_id: '',
            heading: '',
            body: '',
            move: '',
            position_entity_id: '',
            place: {}
        });
    }

    setData(data) {
        data.move = '';
        data.position_entity_id = '';
        super.setData(data);
    }

}

export default Form;