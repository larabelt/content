// helpers
import Tabs from 'belt/core/js/helpers/tabs';

// components (tabs)
import editDefault from './edit-default';
import editText from './edit-text';
import editTree from './edit-tree';
import editParams from './edit-params';

// templates
import edit_html from '../templates/edit.html';

// choose template
// template arrays
// config api

// move section
// good edit type/id
// add section

// nested sections

export default {
    props: {
        section: {}
    },
    data() {
        return {
            tabs: new Tabs({
                router: this.$router,
                toggleable: true,
            }),
        }
    },
    mounted() {
        this.tabs.tab = '';
    },
    components: {
        editText,
        editDefault,
        editTree,
        editParams,
    },
    template: edit_html
}