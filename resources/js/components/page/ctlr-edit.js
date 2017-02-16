
// helpers
import Tabs from 'belt/core/js/helpers/tabs';
import Form from './form';

// components
import categories from 'belt/glue/js/components/categorizable/ctlr-edit';
import handles from '../handle/ctlr-edit';
import tags from 'belt/glue/js/components/tag/taggable/ctlr-edit';

// templates
import heading_html from 'belt/core/js/templates/heading2.html';
import edit_html from './templates/edit.html';
import form_html from './templates/form.html';

export default {
    data() {
        return {
            morphable_type: 'pages',
            morphable_id: this.$route.params.id,
            tabs: new Tabs({router: this.$router})
        }
    },
    components: {
        heading: {template: heading_html},
        edit: {
            data() {
                return {
                    form: new Form(),
                }
            },
            mounted() {
                this.form.show(this.$route.params.id);
            },
            template: form_html,
        },
        categories,
        handles,
        tags,
    },
    template: edit_html,
}