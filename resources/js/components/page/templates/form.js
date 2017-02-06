export default `
    <form role="form">
        <div class="checkbox">
            <label>
                <input type="checkbox" 
                    v-model="item.is_active"
                    v-bind:true-value="1"
                    v-bind:false-value="0"
                    > Is Active
            </label>
        </div>
        <div class="form-group" v-bind:class="{ 'has-error': errors.name }">
            <label for="name">Name</label>
            <input type="name" class="form-control" v-model.trim="item.name"  placeholder="name">
            <span class="help-block" v-show="errors.name">{{ errors.name }}</span>
        </div>
        <div v-if="item.id" class="form-group" v-bind:class="{ 'has-error': errors.slug }">
            <label for="slug">Slug</label>
            <input type="slug" class="form-control" v-model.trim="item.slug"  placeholder="slug">
            <span class="help-block" v-show="errors.slug">{{ errors.slug }}</span>
        </div>
        <div class="form-group" v-bind:class="{ 'has-error': errors.body }">
            <label for="body">Body</label>
            <textarea class="form-control" rows="10" v-model="item.body" v-tinymce="'body'"></textarea>
            <span class="help-block" v-show="errors.body">{{ errors.body }}</span>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary btn-saveable" v-on:click="submit($event)" :class="{ saving: saving, saved: saved }">
                <span v-show="!saving && !saved">Save</span>
                <i v-show="saving" class="fa fa-spinner fa-pulse"></i>
                <i v-show="saved" class="fa fa-check"></i>
            </button>
        </div>
    </form>
`