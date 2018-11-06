<template>
    <div>
        <h4>Create New Handle</h4>
        <p class="help-block">Use the field to add a new handle to this item.</p>
        <form @submit.prevent="store()" @keydown="form.errors.clear($event.target.name)" style="margin-bottom: 20px;">
            <div class="form-group">
                <div class="input-group">
                    <input type="name" class="form-control" v-model="form.url" placeholder="enter handle url">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" :disabled="form.errors.any()">
                            <span v-if="form.saving"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                            <span v-else>add</span>
                        </button>
                    </span>
                </div>
            </div>
        </form>
        <div class="form-group" :class="{ 'has-error': form.error('url') }">
            <span v-for="error in form.error('url')" class="text-danger">{{ error }}</span>
        </div>
    </div>
</template>
<script>
    import Form from 'belt/content/js/handleables/form';
    import shared from 'belt/content/js/handleables/shared';
    import storeAdapter from 'belt/content/js/handleables/store/mixin';

    export default {
        mixins: [shared, storeAdapter],
        props: {},
        data() {
            return {
                form: new Form(),
            }
        },
        mounted() {
            this.setForm();
        },
        methods: {
            setForm() {
                this.form = new Form({entity_type: this.handleableType, entity_id: this.handleableID});
            },
            store() {
                this.form.store()
                    .then(() => {
                        let handle = this.form;
                        this.pushHandles([handle]);
                        this.setForm();
                    })
            },
        },
    }
</script>