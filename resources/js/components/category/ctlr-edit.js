import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import formTemplate from './templates/form.html';

import CategoryForm from './form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Category Editor',
                    subtitle: '',
                    crumbs: [
                        {route: 'categoryIndex', text: 'Categories'}
                    ],
                }
            },
            template: headingTemplate
        },
        'category-form': {
            data() {
                return {
                    form: new CategoryForm(),
                }
            },
            mounted() {
                this.form.show(this.$route.params.id);
            },
            template: formTemplate,
        },
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">Main</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <category-form></category-form>
                        </div>
                    </div>
                </div>
            </section>
        </div>      
        `
}