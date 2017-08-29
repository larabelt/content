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

        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/handles/`;

        this.service = new BaseService({baseUrl: baseUrl});
        this.setData({
            //handleable_id: this.morphable_id,
            //handleable_type: this.morphable_type,
            is_active: 1,
            is_default: 0,
            config_name: 'alias',
            url: '',
            target: '',
        });
    }

}

export default Form;