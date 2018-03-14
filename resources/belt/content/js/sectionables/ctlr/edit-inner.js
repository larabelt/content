import shared from 'belt/content/js/sectionables/ctlr/shared';
import params from 'belt/core/js/paramables/ctlr/index';
import itemAlbum from 'belt/clip/js/albums/sections/edit';
import itemAttachment from 'belt/clip/js/attachments/sections/edit';
import itemBlock from 'belt/content/js/blocks/sections/edit';
import itemBox from 'belt/content/js/sectionables/sections/box/edit';
import itemCustom from 'belt/content/js/sectionables/sections/custom/edit';
import itemItinerary from 'belt/spot/js/itineraries/sections/edit';
import itemMenu from 'belt/menu/js/menus/sections/edit';
import itemTout from 'belt/content/js/touts/sections/edit';

import html from 'belt/content/js/sectionables/templates/edit-inner.html';

export default {
    mixins: [shared],
    computed: {
        templates() {
            let configs = this.$store.getters['configs/data'];
            let group = _.get(configs, 'sections.' + this.active.template_subgroup);
            let templates = {};
            let templateKey = '';
            for (let key in group) {
                templateKey = this.active.template_subgroup + '.' + key;
                let config = group[key];
                templates[templateKey] = config['label'] ? config['label'] : key;
            }
            // templates = _.sortBy(templates, [function (o) {
            //     let sort = o.entity_type ? o.entity_type : 1;
            //     return sort;
            // }]);
            return templates;
        }
    },
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
    template: html
}