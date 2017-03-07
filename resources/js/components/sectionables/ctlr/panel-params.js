import shared from './shared';
import param from '../params/ctlr';

// components
import ParamTable from '../params/table';

// templates
import html from '../templates/panel-params.html';

export default {
    mixins: [shared],
    data() {
        return {
            config: {
                params: []
            },
            params: new ParamTable(),
        }
    },
    components: {
        sectionParam: param,
    },
    mounted() {
        this.params.service.baseUrl = `/api/v1/sections/${this.section.id}/params/`;
        this.params.index();

        let configKey = `${this.section.sectionable_type}.${this.section.template}`;
        this.config = _.get(this.shared.config.data, configKey);
    },
    template: html
}