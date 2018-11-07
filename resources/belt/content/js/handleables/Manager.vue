<template>
    <div class="row">
        <div class="col-md-12">
            <handleable-creator @fetch="fetchHandles"></handleable-creator>
        </div>
        <div class="col-md-12">
            <hr/>
            <h4>Handle List</h4>
            <div v-if="handles.length">
                <p class="help-block">The following handles are linked to this item.</p>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th v-if="hasLocales">Locale</th>
                        <th>Uri</th>
                        <th>Active</th>
                        <th>Is Default</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="handle in handles">
                        <handleable-editor
                                :key="handle.id"
                                :handle_id="handle.id"
                                @fetch="fetchHandles"
                        ></handleable-editor>
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
    import HandleableStore from 'belt/content/js/handleables/store/mixin';
    import TranslatableStore from 'belt/core/js/translations/store/adapter';
    import HandleableCreator from 'belt/content/js/handleables/Creator';
    import HandleableEditor from 'belt/content/js/handleables/Editor';

    export default {
        mixins: [HandleableStore, TranslatableStore],
        props: {
            ...child.propEntityID(),
            ...child.propEntityType(),
            ...child.propForm(),
        },
        components: {
            HandleableCreator,
            HandleableEditor,
        },
    }
</script>