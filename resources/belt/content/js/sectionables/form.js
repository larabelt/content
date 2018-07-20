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
        if (options.entity_id) {
            this.entity_id = options.entity_id;
            this.entity_type = options.entity_type;
        }
        let baseUrl = `/api/v1/${this.entity_type}/${this.entity_id}/sections/`;
        this.service = new BaseService({baseUrl: baseUrl});

        // data
        this.setData({
            id: '',
            owner_id: '',
            owner_type: '',
            parent_id: '',
            sectionable_id: '',
            sectionable_type: '',
            subtype: '',
            heading: '',
            before: '',
            after: '',
            template_subgroup: '',
        });
        if (options.section) {
            this.setData(options.section);
        }
    }

}

export default Form;