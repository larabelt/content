import heading from 'ohio/core/js/components/base/heading';
import form from './form';

export default {
    components: {
        'heading': heading,
        'form-handle': form,
    },
    data() {
        return {
            id: this.$route.params.id,
            handle: {},
            msg: '',
        }
    },
    template: `
        <div>
            <heading 
                title="Handle Editor" 
                :subtitle=handle.url 
                ></heading>
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Handle {{ msg }}</h3>
                        </div>
                        <form-handle></form-handle>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    `
}