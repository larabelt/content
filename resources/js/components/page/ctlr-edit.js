import Tabs from 'ohio/core/js/helpers/tabs';
import headingTemplate from 'ohio/core/js/templates/heading2.html';
import editTemplate from './templates/edit.html';
import formTemplate from './templates/form.html';
import Form from './form';
import handleable from '../handle/ctlr-edit';
import taggable from '../tag/taggable/ctlr-edit';

export default {
    data() {
        return {
            morphable_type: 'pages',
            morphable_id: this.$route.params.id,
            tabs: new Tabs({router: this.$router})
        }
    },
    components: {
        heading: {template: headingTemplate},
        pageForm: {
            data() {
                return {
                    form: new Form(),
                }
            },
            mounted() {
                //this.$route.push({hash: 'foo'});
                //this.$router.push({hash: 'foo'});
                this.form.show(this.$route.params.id);
            },
            template: formTemplate,
        },
        handleable,
        taggable,
    },
    template: editTemplate,
}