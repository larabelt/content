<template>
    <tr class="form-inline">
        <td><input class="form-control" type="text" v-model="handle.url" @change="update"/></td>
        <td>
            <input type="checkbox"
                   v-model="handle.is_active"
                   :true-value="true"
                   :false-value="false"
                   @change="update"
            />
        </td>
        <td>
            <input type="checkbox"
                   v-model="handle.is_default"
                   :true-value="true"
                   :false-value="false"
                   @change="makeDefault"
            />
        </td>
        <td class="text-right">
            <button class="btn btn-default btn-xs" @click.prevent="trash"><i class="fa fa-trash"></i></button>
            <button v-if="handle.saving" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-spin"></i></button>
            <button v-else class="btn btn-default btn-xs" @click.prevent="update"><i class="fa fa-save"></i></button>
        </td>
    </tr>
</template>
<script>
    import shared from 'belt/content/js/handleables/shared';
    import storeAdapter from 'belt/content/js/handleables/store/mixin';

    export default {
        mixins: [shared, storeAdapter],
        props: {
            handle_id: {
                type: Number,
                required: true,
            }
        },
        computed: {
            handle() {
                return this.handles.find(handle => handle.id === this.handle_id);
            }
        },
        methods: {
            makeDefault() {
                _.each(this.handles, function (handle) {
                    handle.is_default = false;
                });
                this.update();
            },
            trash() {
                this.handle.destroy(this.handle.id)
                    .then(() => {
                        this.dropHandle(this.handle);
                    });
            },
            update: _.debounce(function () {
                return new Promise((resolve, reject) => {
                    this.handle.submit()
                        .then(response => {

                            resolve(response);
                        })
                        .catch(error => {
                            reject(error);
                        })
                });
            }, 300, {
                leading: true,
                trailing: false
            }),
        },
    }
</script>