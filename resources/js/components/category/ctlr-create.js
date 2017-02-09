import headingTemplate from 'ohio/core/js/templates/base/heading.html';
import formTemplate from './templates/form.html';
import CategoryForm from './form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Category Creator',
                    subtitle: '',
                    crumbs: [
                        {route: 'categoryIndex', text: 'Categories'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'category-form': {
            data() {
                return {
                    form: new CategoryForm(),
                }
            },
            mounted() {

                // button status
                // delete objects...
                // all service calls (pagination)

                this.form.setRouter(this.$router);
            },
            template: formTemplate,
        },
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <category-form></category-form>
                    </div>
                </div>
            </section>
        </div>
        `
}