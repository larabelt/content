import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class BlockForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/blocks/'});
        this.routeEditName = 'blocks.edit';
        this.setData({
            id: '',
            team_id: '',
            is_active: 0,
            name: '',
            slug: '',
            rating: '',
            body: '',
            intro: '',
            phone: '',
            phone_tollfree: '',
            hours: '',
            url: '',
            email: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
            starts_at: '',
            ends_at: '',
            subtype: '',
            priority: 0,
        })
    }

}

export default BlockForm;