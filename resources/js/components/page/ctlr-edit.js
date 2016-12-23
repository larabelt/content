import headingTemplate from 'ohio/core/js/templates/base/heading';
import pageService from './service';
import pageFormTemplate from './templates/form';
import handleable from '../handle/ctlr-edit';
import taggable from '../tag/taggable/ctlr-edit';

export default {
    data() {
        return {
            morphable_type: 'pages',
            morphable_id: this.$route.params.id,
        }
    },
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
                this.item.id = this.$route.params.id;
                this.get();
            },
        },
        handleable,
        taggable,
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="row">
                    <div class="col-md-9 hide">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Page</h3>
                            </div>
                            <page-form></page-form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <handleable></handleable>
                    </div>
                    <div class="col-md-9 hide">
                        <taggable></taggable>
                    </div>
                </div>
            </section>
        </div>
        `
}