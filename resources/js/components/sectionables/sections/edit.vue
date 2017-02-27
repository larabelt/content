<template>
    <div v-if="isType">
        <div class="row">
            <div class="col-md-12">
                <form role="form" @submit.prevent="form.submit()" @keydown="form.errors.clear($event.target.name)">
                    <div class="form-group" :class="{ 'has-error': form.error('template') }">
                        <label for="template">Template</label>
                        <input type="text" class="form-control" v-model="form.template" placeholder="template">
                        <span v-for="error in form.error('template')" class="content-danger">{{ error }}</span>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">
                            <span v-if="form.saving"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                            <span v-else>Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row alt-box-footer">
            <div class="col-md-12">
                <create :section="section"></create>
            </div>
        </div>
    </div>
</template>

<script>
// helpers
import Form from '../form';

// components
import create from '../ctlr/create';

export default {
    props: {
        section: {}
    },
    computed: {
        isType() {
            return this.section.sectionable_type == 'sections';
        }
    },
    data() {
        let form = new Form();
        form.setData(this.section);
        return {
            form: form,
            table: this.$parent.table,
        }
    },
    components: {
        create,
    },
}

</script>