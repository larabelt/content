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

        //let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/sections/`;
        //let baseUrl = `/api/v1/sections/?page_id=${this.morphable_id}`;
        let baseUrl = `/api/v1/sections/`;

        this.service = new BaseService({baseUrl: baseUrl});
        this.setData({
            id: '',
            page_id: '',
            sectionable_id: '',
            sectionable_type: '',
            template: '',
            header: '',
            body: '',
            footer: '',
        });
    }

}

export default Form;