import headingTemplate from 'belt/core/js/templates/base/heading.html';
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
                        {route: 'blockIndex', text: 'Blocks'}
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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">Main</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <block-form></block-form>
                        </div>
                    </div>
                </div>
            </section>
        </div>      
        `
}