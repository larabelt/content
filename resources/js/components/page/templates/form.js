export default `
    <form page="form">
        <div class="box-body">
            <div class="checkbox">
                <label>
                    <input type="checkbox" 
                        v-model="pages.page.is_active"
                        v-bind:true-value="1"
                        v-bind:false-value="0"
                        > Is Active
                </label>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': pages.errors.name }">
                <label for="name">Name</label>
                <input type="name" class="form-control" v-model.trim="pages.page.name"  placeholder="name">
                <span class="help-page" v-show="pages.errors.name">{{ pages.errors.name }}</span>
            </div>
            <div v-if="pages.page.id" class="form-group" v-bind:class="{ 'has-error': pages.errors.slug }">
                <label for="slug">Slug</label>
                <input type="slug" class="form-control" v-model.trim="pages.page.slug"  placeholder="slug">
                <span class="help-page" v-show="pages.errors.slug">{{ pages.errors.slug }}</span>
            </div>
            <div class="form-group" v-bind:class="{ 'has-error': pages.errors.body }">
                <label for="body">Body</label>
                <textarea class="form-control" rows="10" v-model="pages.page.body"></textarea>
                <span class="help-page" v-show="pages.errors.body">{{ pages.errors.body }}</span>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" v-on:click="submitPage($event)">Save</button>
            <span v-show="pages.saving">saving <i class="fa fa-spinner fa-spin" /></span>
            <span v-show="pages.saved">saved <i class="fa fa-floppy-o" /></span>
        </div>
    </form>
`