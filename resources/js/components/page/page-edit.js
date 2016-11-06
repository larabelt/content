import form from './templates/form-edit';

export default {
    components: {
        'form-page': form,
    },
    data() {
        return {
            id: this.$route.params.id
        }
    },
    mounted() {
        //console.log(this);
    },
    template: `
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Page</h3>
                    </div>
                    <form-page type="edit"></form-page>
                </div>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
    `
}