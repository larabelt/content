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

        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/params/`;

        this.service = new BaseService({baseUrl: baseUrl});
        this.setData({
            paramable_id: '',
            paramable_type: '',
            key: '',
            value: '',
        });
    }

}

export default Form;