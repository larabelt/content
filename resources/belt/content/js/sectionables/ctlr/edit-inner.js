import shared from 'belt/content/js/sectionables/ctlr/shared';

//import params from 'belt/content/js/sectionables/params/params';
import params from 'belt/core/js/paramables/ctlr/index';

// section items
import itemAlbum from 'belt/clip/js/albums/sections/edit';
import itemAttachment from 'belt/clip/js/attachments/sections/edit';
import itemBlock from 'belt/content/js/blocks/sections/edit';
import itemBox from 'belt/content/js/sectionables/sections/box/edit';
import itemCustom from 'belt/content/js/sectionables/sections/custom/edit';
import itemItinerary from 'belt/spot/js/itineraries/sections/edit';
import itemMenu from 'belt/menu/js/menus/sections/edit';
import itemTout from 'belt/content/js/touts/sections/edit';

// templates
import inner_html from 'belt/content/js/sectionables/templates/edit-inner.html';

export default {
    mixins: [shared],
    data() {
        return {
            templates: {},
        }
    },
    computed: {
        // dropdown() {
        //     let type = this.active.sectionable_type;
        //     let configs = this.$store.getters['configs/data'];
        //     configs = configs[type];
        //     let templates = {};
        //     for (let key in configs) {
        //         let config = configs[key];
        //         templates[key] = config['label'] ? config['label'] : key;
        //     }
        //     return templates;
        // },
    },
    mounted() {
        let type = this.active.sectionable_type;
        this.$store.dispatch('configs/loadType', type)
            .then((configs) => {
                let templates = {};
                for (let key in configs) {
                    let config = configs[key];
                    templates[key] = config['label'] ? config['label'] : key;
                }
                this.templates = templates;
            });
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
    template: inner_html
}