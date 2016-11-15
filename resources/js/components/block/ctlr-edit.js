import headingTemplate from 'ohio/core/js/templates/base/heading';
import blockService from './service';
import blockFormTemplate from './templates/form';
import handleService from '../handle/service';
import handleIndexTemplate from '../handle/templates/owned-index';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Block Editor',
                    subtitle: '',
                    crumbs: [
                        {url: '/admin/ohio/content/blocks', text: 'Manager'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'block-form': {
            mixins: [blockService],
            template: blockFormTemplate,
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
                    params.handleable_type = 'content/block';
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
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Block</h3>
                            </div>
                            <block-form></block-form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        `
}