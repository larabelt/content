<template>
    <tr class="form-inline">
        <td v-if="hasLocales">
            <input-locale
                    :form="handle"
                    @change-locale="update"
            ></input-locale>
        </td>
        <td>
            <input
                    class="form-control"
                    type="text"
                    v-model="handle.url"
                    @change="update"
                    @keydown="handle.errors.clear('url')"
                    style="width:95%"
            />
            <div class="form-group" :class="{ 'has-error': handle.error('url') }">
                <span v-for="error in handle.error('url')" class="text-danger">{{ error }}</span>
            </div>
        </td>
        <td>
            <input-psuedo-checkbox
                    :form="handle"
                    column="is_active"
                    @toggle="update">
            </input-psuedo-checkbox>
        </td>
        <td>
            <input-psuedo-checkbox
                    :form="handle"
                    column="is_default"
                    @toggle="makeDefault"
            ></input-psuedo-checkbox>
        </td>
        <td class="text-right">
            <button-inline-trash @trash="trash"></button-inline-trash>
            <!--<button class="btn btn-default btn-xs" @click.prevent="trash"><i class="fa fa-trash"></i></button>-->
            <button v-if="handle.saving" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-spin"></i></button>
            <button v-else class="btn btn-default btn-xs" @click.prevent="update"><i class="fa fa-save"></i></button>
        </td>
    </tr>
</template>
<script>
    import * as child from 'belt/core/js/helpers/child';
    import HandleableStore from 'belt/content/js/handleables/store/mixin';
    import TranslatableStore from 'belt/core/js/translations/store/adapter';
    import FilterLocale from 'belt/core/js/locales/filter/FilterLocale';

    export default {
        mixins: [HandleableStore, TranslatableStore],
        props: {
            ...child.propEntityID(),
            ...child.propEntityType(),
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
                if (this.handle.is_default) {
                    _.each(this.handles, function (handle) {
                        handle.is_default = false;
                    });
                    this.handle.is_default = true;
                }
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
        components: {
            FilterLocale,
        }
    }
</script>