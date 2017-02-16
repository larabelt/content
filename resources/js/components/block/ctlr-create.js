import headingTemplate from 'belt/core/js/templates/base/heading.html';
import blockService from './service';
import blockFormTemplate from './templates/form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Block Creator',
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
        },
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <block-form></block-form>
                    </div>
                </div>
            </section>
        </div>
        `
}