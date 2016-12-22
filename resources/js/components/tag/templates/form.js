export default `
    <form tag="form">
        <div class="box-body">
            <div class="form-group" v-bind:class="{ 'has-error': tags.errors.name }">
                <label for="name">Name</label>
                <input type="name" class="form-control" v-model.trim="tags.tag.name"  placeholder="name">
                <span class="help-tag" v-show="tags.errors.name">{{ tags.errors.name }}</span>
            </div>
            <div v-if="tags.tag.id" class="form-group" v-bind:class="{ 'has-error': tags.errors.slug }">
                <label for="slug">Slug</label>
                <input type="slug" class="form-control" v-model.trim="tags.tag.slug"  placeholder="slug">
                <span class="help-tag" v-show="tags.errors.slug">{{ tags.errors.slug }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': tags.errors.body }">
                <label for="body">Body</label>
                <textarea class="form-control" rows="10" v-model="tags.tag.body"></textarea>
                <span class="help-tag" v-show="tags.errors.body">{{ tags.errors.body }}</span>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" v-on:click="submitTag($event)">Save</button>
            <span v-show="tags.saving">saving <i class="fa fa-spinner fa-spin" /></span>
            <span v-show="tags.saved">saved <i class="fa fa-floppy-o" /></span>
        </div>
    </form>
`