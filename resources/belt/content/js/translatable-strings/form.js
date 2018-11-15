import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class TranslationStringForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/translatable-strings/'});
        this.routeEditName = 'translatableStrings.edit';
        this.setData({
            id: '',
            name: '',
            title: '',
            level: '',
            scope: '',
            description: '',
        })
    }

}

export default TranslationStringForm;