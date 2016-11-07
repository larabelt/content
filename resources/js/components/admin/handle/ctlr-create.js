import form from './form';
import heading from 'ohio/core/js/components/base/heading';

export default {
    components: {
        'form-handle': form,
        'heading': heading,
    },
    template: `
        <div>
            <heading title="Handle Creator"></heading>
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Create Handle</h3>
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