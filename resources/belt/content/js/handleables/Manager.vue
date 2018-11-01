<template>
    <div class="row">
        <div class="col-md-12">
            <h4>Create Handles</h4>
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
        <div class="col-md-12">
            <hr/>
            <h4>Handle List</h4>
            <div v-if="table.items.length">
                <p class="help-block">The following handles are linked to this item.</p>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Active</th>
                        <th>Type</th>
                        <th>Is Default</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="handle in table.items">
                        <handleable-editor :handle="handle"></handleable-editor>
                    </template>
                    </tbody>
                </table>
                <pagination></pagination>
            </div>
            <div v-else>
                <p style="font-style: italic;">No handles are currently linked to this item.</p>
            </div>
        </div>
    </div>
</template>
<script>
    import * as child from 'belt/core/js/helpers/child';
    import Form from 'belt/content/js/handleables/form';
    import Table from 'belt/content/js/handleables/table';
    import HandleableEditor from 'belt/content/js/handleables/Editor';

    export default {
        props: {
            ...child.propEntityID(),
            ...child.propEntityType(),
        },
        data() {
            return {
                table: new Table({entity_type: this.entity_type, entity_id: this.entity_id}),
                form: new Form({entity_type: this.entity_type, entity_id: this.entity_id}),
            }
        },
        mounted() {
            this.table.index();
        },
        components: {
            HandleableEditor,
        },
        methods: {
            store() {
                this.form.store()
                    .then(() => {
                        this.table.index();
                        this.form.reset()
                    })
            }
        },
    }
</script>