import heading from 'ohio/core/js/components/base/heading';
import pageForm from './form';
import handleIndex from '../handle/handle-index.js';

export default {
    components: {
        'heading': heading,
        'page-form': pageForm,
        'handle-index': handleIndex,
    },
    data() {
        return {
            id: this.$route.params.id,
            page: {},
            msg: '',
        }
    },
    template: `
        <div>
            <heading 
                title="Page Editor" 
                :subtitle=page.name 
                ></heading>
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Page {{ msg }}</h3>
                        </div>
                        <page-form></page-form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Handles</h3>
                        </div>
                        <handle-index></handle-index>
                    </div>
                </div>
            </div>
        </div>
    `
}