import shared from './panel-shared';

// templates
import panelItem_html from '../templates/panel-item.html';

// section items
import itemAttachment from 'belt/clip/js/components/attachments/sections/edit';
import itemBlock from 'belt/content/js/components/blocks/sections/edit';
import itemBox from '../sections/box/edit';
import itemCustom from '../sections/custom/edit';
import itemMenu from 'belt/menu/js/components/menus/sections/edit';
import itemTout from 'belt/content/js/components/touts/sections/edit';

export default {
    mixins: [shared],
    components: {
        itemAttachment,
        itemBlock,
        itemBox,
        itemCustom,
        itemMenu,
        itemTout,
    },
    template: panelItem_html
}