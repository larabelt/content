import form from './form';
import heading from 'ohio/core/js/components/base/heading';

export default {
    components: {
        'form-page': form,
        'heading': heading,
    },
    template: `
        <div>
            <heading title="Page Creator"></heading>
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Page</h3>
                        </div>
                        <form-page></form-page>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    `
}