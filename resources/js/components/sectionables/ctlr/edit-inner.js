import shared from 'belt/content/js/components/sectionables/ctlr/shared';

import params from 'belt/content/js/components/sectionables/params/params';

// section items
import itemAlbum from 'belt/clip/js/components/albums/sections/edit';
import itemAttachment from 'belt/clip/js/components/attachments/sections/edit';
import itemBlock from 'belt/content/js/components/blocks/sections/edit';
import itemBox from 'belt/content/js/components/sectionables/sections/box/edit';
import itemCustom from 'belt/content/js/components/sectionables/sections/custom/edit';
import itemItinerary from 'belt/spot/js/components/itineraries/sections/edit';
import itemMenu from 'belt/menu/js/components/menus/sections/edit';
import itemTout from 'belt/content/js/components/touts/sections/edit';

// templates
import inner_html from 'belt/content/js/components/sectionables/templates/edit-inner.html';

export default {
    mixins: [shared],
    components: {
        params,
        itemAlbum,
        itemAttachment,
        itemBlock,
        itemBox,
        itemCustom,
        itemItinerary,
        itemMenu,
        itemTout,
    },
    template: inner_html
}