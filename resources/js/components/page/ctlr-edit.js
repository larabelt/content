import headingTemplate from 'ohio/core/js/templates/base/heading';
import pageService from './service';
import pageFormTemplate from './templates/form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Page Editor',
                    subtitle: '',
                    crumbs: [
                        {url: '/admin/ohio/content/pages', text: 'Manager'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'page-form': {
            mixins: [pageService],
            template: pageFormTemplate,
            mounted() {
                this.pages.page.id = this.$route.params.id;
                this.getPage();
            },
        },
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="row">
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Page</h3>
                            </div>
                            <page-form></page-form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        `
}