import headingTemplate from 'ohio/core/js/templates/base/heading';
import tagService from './service';
import tagFormTemplate from './templates/form';

export default {
    components: {
        'heading': {
            data() {
                return {
                    title: 'Tag Creator',
                    subtitle: '',
                    crumbs: [
                        {url: '/admin/ohio/content/tags', text: 'Manager'}
                    ],
                }
            },
            'template': headingTemplate
        },
        'tag-form': {
            mixins: [tagService],
            template: tagFormTemplate,
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
                                <h3 class="box-title">Create Tag</h3>
                            </div>
                            <tag-form></tag-form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        `
}