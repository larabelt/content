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
        template: {default: ''},
    },

    data() {

        let morphable_type = this.$parent.morphable_type;
        let morphable_id = this.$parent.morphable_id;

        console.log(111);
        console.log({not: 1, template: this.template});

        return {
            detached: new Table({
                morphable_type: morphable_type,
                morphable_id: morphable_id,
                query: {not: 1, template: this.template},
            }),
            form: new Form({
                morphable_type: this.$parent.morphable_type,
                morphable_id: this.$parent.morphable_id,
            }),
            morphable_type: morphable_type,
            morphable_id: morphable_id,
            tabs: new Tabs({router: this.$router, default: 'list'}),
        }
    },
    beforeMount() {
        this.$store.dispatch('clippable/set', {morphableType: this.morphable_type, morphableID: this.morphable_id});
        this.$store.dispatch('clippable/construct');
        this.table.updateQuery({template: this.template});
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