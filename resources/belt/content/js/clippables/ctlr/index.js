import clippable from 'belt/content/js/clippables/shared';

import list from 'belt/content/js/clippables/ctlr/list';
import search from 'belt/content/js/clippables/ctlr/search';
import sort from 'belt/content/js/clippables/ctlr/sort';
import uploader from 'belt/content/js/base/uploader/ctlr';
import Tabs from 'belt/core/js/helpers/tabs';
import Table from 'belt/content/js/clippables/table';
import Form from 'belt/content/js/clippables/form';
import uploader_html from 'belt/content/js/base/uploader/template.html';
import html from 'belt/content/js/clippables/templates/index.html';

export default {
    mixins: [clippable],
    props: {
        path: {default: ''},
        driver: {default: ''},
        multiple: {default: true},
        subtype: {default: ''},
    },

    data() {

        let entity_type = this.$parent.entity_type;
        let entity_id = this.$parent.entity_id;

        return {
            detached: new Table({
                entity_type: entity_type,
                entity_id: entity_id,
                query: {not: 1, subtype: this.subtype},
            }),
            form: new Form({
                entity_type: this.$parent.entity_type,
                entity_id: this.$parent.entity_id,
            }),
            entity_type: entity_type,
            entity_id: entity_id,
            tabs: new Tabs({router: this.$router, default: 'sort'}),
        }
    },
    beforeMount() {
        this.$store.dispatch('clippable/set', {entity_type: this.entity_type, entity_id: this.entity_id});
        this.$store.dispatch('clippable/construct');
        this.table.updateQuery({subtype: this.subtype});
        this.$store.dispatch('clippable/load');
    },
    components: {
        list,
        search,
        sort,
        uploader: {
            mixins: [uploader],
            methods: {
                onUploadSuccess(attachment) {
                    this.$parent.form.setData({id: attachment.id});
                    this.$parent.form.store()
                        .then(() => {
                            this.$store.dispatch('clippable/load');
                        })
                },
            },
            template: uploader_html
        },
    },
    methods: {
        setTab(tab) {
            this.tabs.set(tab);
            this.table.query.perPage = 10;
            if (tab == 'sort') {
                this.table.query.perPage = 9999;
            }
            this.table.index();
        }
    },
    template: html
}