<template>
    <div v-if="isType">
        <form role="form" @submit.prevent="form.submit()" @keydown="form.errors.clear($event.target.name)">
            <div class="form-group" :class="{ 'has-error': form.error('template') }">
                <label for="template">Template</label>
                <input type="text" class="form-control" v-model="form.template" placeholder="template">
                <span v-for="error in form.error('template')" class="contents-danger">{{ error }}</span>
            </div>
            <div class="form-group" :class="{ 'has-error': form.error('sectionable_id') }">
                <label for="sectionable_id">Sectionable Id</label>
                <input type="text" class="form-control" v-model="form.sectionable_id" placeholder="sectionable id">
                <span v-for="error in form.error('sectionable_id')" class="contents-danger">{{ error }}</span>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">
                    <span v-if="form.saving"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                    <span v-else>Save</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
// helpers
import Form from '../form';

export default {
    props: {
        section: {}
    },
    computed: {
        isType() {
            return this.section.sectionable_type == 'touts';
        }
    },
    data() {
        let form = new Form();
        form.setData(this.section);
        return {
            form: form
        }
    },
}


</script>