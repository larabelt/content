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

        // service
        if (options.morphable_id) {
            this.morphable_id = options.morphable_id;
            this.morphable_type = options.morphable_type;
        }
        let baseUrl = `/api/v1/${this.morphable_type}/${this.morphable_id}/sections/`;
        this.service = new BaseService({baseUrl: baseUrl});

        // data
        this.setData({
            id: '',
            owner_id: '',
            owner_type: '',
            parent_id: '',
            sectionable_id: '',
            sectionable_type: '',
            template: '',
            heading: '',
            before: '',
            after: '',
        });
        if (options.section) {
            this.setData(options.section);
        }
    }

}

export default Form;