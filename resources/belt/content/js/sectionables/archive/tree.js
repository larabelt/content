import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class TreeForm extends BaseForm {

    /**
     * Create a new Form instance.
     *
     * @param {object} options
     */
    constructor(options = {}) {
        super(options);

        let section_id = null;
        if (options.section.id) {
            section_id = options.section.id;
        }

        let baseUrl = `/api/v1/sections/${section_id}/tree/`;
        this.service = new BaseService({baseUrl: baseUrl});

        // data
        this.setData({
            neighbor_id: '',
            move: '',
        });
    }

}

export default TreeForm;