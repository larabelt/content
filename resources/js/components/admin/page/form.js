export default {
    data() {
        return {
            page: {},
            saving: false,
            saved: false,
            errors: {}
        }
    },
    methods: {
        submit(event) {
            event.preventDefault();
            this.saving = true;
            this.saved = false;
            if (this.$parent.id) {
                return this.put(this.page);
            }
            return this.post(this.page);
        },
        get() {
            this.$http.get('/api/v1/pages/' + this.$parent.id).then((response) => {
                this.page = this.$parent.page = response.data;
            }, (response) => {

            });
        },
        put(params) {
            this.errors = {};
            this.$http.put('/api/v1/pages/' + params.id, params).then((response) => {
                this.page = this.$parent.page = response.data;
                this.saved = true;
                this.$parent.msg = 'saved'; //test
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        },
        post(params) {
            this.errors = {};
            this.$http.post('/api/v1/pages', params ).then((response) => {
                this.$router.push({ name: 'pageEdit', params: { id: response.data.id }})
            }, (response) => {
                if (response.status == 422) {
                    this.errors = response.data.message;
                }
            });
            this.saving = false;
        }
    },
    mounted() {
        if (this.$parent.id) {
            this.get();
        }
    },
    template: `
        <form role="form">
            <div class="box-body">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" 
                            v-model="page.is_active"
                            v-bind:true-value="1"
                            v-bind:false-value="0"
                            > Is Active
                    </label>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.name }">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" v-model.trim="page.name"  placeholder="name">
                    <span class="help-block" v-show="errors.name">{{ errors.name }}</span>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.body }">
                    <label for="body">Body</label>
                    <textarea class="form-control" rows="10" v-model="page.body"></textarea>
                    <span class="help-block" v-show="errors.body">{{ errors.body }}</span>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" v-on:click="submit($event)">Save</button>
                <span v-show="saving">saving <i class="fa fa-spinner fa-spin" /></span>
                <span v-show="saved">saved <i class="fa fa-floppy-o" /></span>
            </div>
        </form>
`
};