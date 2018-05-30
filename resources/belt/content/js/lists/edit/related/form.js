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

        let baseUrl = `/api/v1/lists/${this.morphable_id}/listables/`;

        this.service = new BaseService({baseUrl: baseUrl});
        this.routeEditName = 'lists.listables';
        this.setData({
            id: '',
            move: '',
            position_entity_id: '',
        });
    }

}

export default Form;