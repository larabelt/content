import headingTemplate from 'ohio/core/js/templates/base/heading';
import pageService from './service';
import pageFormTemplate from './templates/form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Page Creator',
                    subtitle: '',
                    crumbs: [
                        {route: 'pageIndex', text: 'Pages'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'page-form': {
            mixins: [pageService],
            template: pageFormTemplate,
        },
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <page-form></page-form>
                    </div>
                </div>
            </section>
        </div>
        `
}