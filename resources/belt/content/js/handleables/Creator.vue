<template>
    <div>
        <h4>Create New Handle</h4>
        <p class="help-block">Use the field to add a new handle to this item.</p>
        <form @submit.prevent="store()" @keydown="createForm.errors.clear($event.target.name)" style="margin-bottom: 20px;" class="form-inline">
            <div v-if="hasLocales" class="form-group">
                <input-locale
                        :form="createForm"
                ></input-locale>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="name" class="form-control" v-model="createForm.url" placeholder="enter handle url">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" :disabled="createForm.errors.any()">
                            <span v-if="createForm.saving"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                            <span v-else>add</span>
                        </button>
                    </span>
                </div>
            </div>
        </form>
        <div class="form-group" :class="{ 'has-error': createForm.error('url') }">
            <span v-for="error in createForm.error('url')" class="text-danger">{{ error }}</span>
        </div>
    </div>
</template>
<script>
    import * as child from 'belt/core/js/helpers/child';
    import Form from 'belt/content/js/handleables/form';
    import TranslatableStore from 'belt/core/js/translations/store/adapter';
    import HandleableStore from 'belt/content/js/handleables/store/mixin';

    export default {
        mixins: [HandleableStore, TranslatableStore],
        props: {
            ...child.propEntityID(),
            ...child.propEntityType(),
        },
        data() {
            return {
                createForm: new Form(),
            }
        },
        created() {
            this.setCreateForm();
        },
        methods: {
            setCreateForm() {
                this.createForm = new Form({entity_type: this.handleableType, entity_id: this.handleableID});
            },
            store() {
                this.createForm.store()
                    .then(() => {
                        let handle = this.createForm;
                        this.pushHandles([handle]);
                        this.setCreateForm();
                    })
            },
        },
    }
</script>