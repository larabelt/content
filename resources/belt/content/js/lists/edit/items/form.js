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

        let list_id = options.list_id;

        let baseUrl = `/api/v1/lists/${list_id}/items/`;

        this.service = new BaseService({baseUrl: baseUrl});
        this.routeEditName = 'lists.items';
        this.setData({
            id: '',
            list_id: '',
            template: '',
            move: '',
            position_entity_id: '',
            //listable_type: '',
            //listable_id: '',
        });
    }

}

export default Form;