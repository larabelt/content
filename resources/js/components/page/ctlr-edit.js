import headingTemplate from 'ohio/core/js/templates/base/heading';
import pageService from './service';
import pageFormTemplate from './templates/form';
import handleService from '../handle/service';
import handleIndexTemplate from '../handle/templates/owned-index';
import tagService from '../tag/service';
import tagIndexTemplate from '../tag/templates/owned-index';

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
                this.id = this.$route.params.id;
                this.get();
            },
        },
        'handle-index': {
            mixins: [handleService],
            template: handleIndexTemplate,
            mounted() {
                this.index();
            },
            methods: {
                getParams() {
                    let params = this.getUrlParams();
                    params.handleable_id = this.$route.params.id;
                    params.handleable_type = 'content/page';
                    return params;
                },
            },
        },
        'tag-index': {
            mixins: [tagService],
            template: tagIndexTemplate,
            mounted() {
                this.index();
            },
            methods: {
                getParams() {
                    let params = this.getUrlParams();
                    params.tagable_id = this.$route.params.id;
                    params.tagable_type = 'content/page';
                    return params;
                },
            },
        },
    },
    data() {
        return {
            id: this.$route.params.id
        }
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
                    <div class="col-md-9 hide">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Handles</h3>
                            </div>
                            <handle-index></handle-index>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tags</h3>
                            </div>
                            <tag-index></tag-index>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        `
}