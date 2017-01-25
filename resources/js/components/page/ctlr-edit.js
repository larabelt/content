import headingTemplate from 'ohio/core/js/templates/base/heading';
import pageService from './service';
import pageFormTemplate from './templates/form';
import handleable from '../handle/ctlr-edit';
import taggable from '../tag/taggable/ctlr-edit';
import fileable from 'ohio/storage/js/components/fileable/fileable';

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
                        {route: 'pageIndex', text: 'Pages'}
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
        fileable,
    },
    template: `
        <div>
            <heading></heading>
            <section class="content">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="false">Main</a></li>
                        <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Files</a></li>
                        <li class=""><a href="#tab_3-3" data-toggle="tab" aria-expanded="false">Handles</a></li>
                        <li class=""><a href="#tab_4-4" data-toggle="tab" aria-expanded="false">Tags</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <page-form></page-form>
                        </div>
                        <div class="tab-pane" id="tab_2-2">
                            <fileable uploader_path="pages"></fileable>
                        </div>
                        <div class="tab-pane" id="tab_3-3">
                            <handleable></handleable>
                        </div>
                        <div class="tab-pane" id="tab_4-4">
                            <taggable></taggable>
                        </div>
                    </div>
                </div>
            </section>
        </div>        
        `
}