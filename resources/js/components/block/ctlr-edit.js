import headingTemplate from 'ohio/core/js/templates/base/heading';
import blockService from './service';
import blockFormTemplate from './templates/form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Block Editor',
                    subtitle: '',
                    crumbs: [
                        {route: 'blockIndex', text: 'Manager'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'block-form': {
            mixins: [blockService],
            template: blockFormTemplate,
            mounted() {
                this.item.id = this.$route.params.id;
                this.get();
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