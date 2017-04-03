import shared from './panel-shared';
import param from '../params/ctlr';
import ParamTable from '../params/table';

// templates
import panelContent_html from '../templates/panel-content.html';

// section items
import itemAlbum from 'belt/clip/js/components/albums/sections/edit';
import itemAttachment from 'belt/clip/js/components/attachments/sections/edit';
import itemBlock from 'belt/content/js/components/blocks/sections/edit';
import itemBox from '../sections/box/edit';
import itemCustom from '../sections/custom/edit';
import itemMenu from 'belt/menu/js/components/menus/sections/edit';
import itemTout from 'belt/content/js/components/touts/sections/edit';

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
        itemAlbum,
        itemAttachment,
        itemBlock,
        itemBox,
        itemCustom,
        itemMenu,
        itemTout,
        sectionParam: param,
    },
    mounted() {
        this.params.service.baseUrl = `/api/v1/sections/${this.section.id}/params/`;
        this.params.index();

        let configKey = `${this.section.sectionable_type}.${this.section.template}`;
        this.config = _.get(this.configs.data, configKey);
    },
    methods: {
        destroy(id) {
            let form = this.active;
            let table = this.table;
            form.destroy(id)
                .then(function () {
                    table.index();
                });
        }
    },
    template: panelContent_html
}