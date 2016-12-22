export default `
    <form block="form">
        <div class="box-body">
            <div class="form-group" v-bind:class="{ 'has-error': blocks.errors.name }">
                <label for="name">Name</label>
                <input type="name" class="form-control" v-model.trim="blocks.block.name"  placeholder="name">
                <span class="help-block" v-show="blocks.errors.name">{{ blocks.errors.name }}</span>
            </div>
            <div v-if="blocks.block.id" class="form-group" v-bind:class="{ 'has-error': blocks.errors.slug }">
                <label for="slug">Slug</label>
                <input type="slug" class="form-control" v-model.trim="blocks.block.slug"  placeholder="slug">
                <span class="help-block" v-show="blocks.errors.slug">{{ blocks.errors.slug }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': blocks.errors.body }">
                <label for="body">Body</label>
                <textarea class="form-control" rows="10" v-model="blocks.block.body"></textarea>
                <span class="help-block" v-show="blocks.errors.body">{{ blocks.errors.body }}</span>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" v-on:click="submitBlock($event)">Save</button>
            <span v-show="blocks.saving">saving <i class="fa fa-spinner fa-spin" /></span>
            <span v-show="blocks.saved">saved <i class="fa fa-floppy-o" /></span>
        </div>
    </form>
`