export default {
    data() {
        return {
            handle: {},
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
                return this.put(this.handle);
            }
            return this.post(this.handle);
        },
        get() {
            this.$http.get('/api/v1/handles/' + this.$parent.id).then((response) => {
                this.handle = this.$parent.handle = response.data;
            }, (response) => {

            });
        },
        put(params) {
            this.errors = {};
            this.$http.put('/api/v1/handles/' + params.id, params).then((response) => {
                this.handle = this.$parent.handle = response.data;
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
            this.$http.post('/api/v1/handles', params ).then((response) => {
                this.$router.push({ name: 'handleEdit', params: { id: response.data.id }})
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
                <div class="form-group" v-bind:class="{ 'has-error': errors.url }">
                    <label for="url">Url</label>
                    <input type="url" class="form-control" v-model.trim="handle.url"  placeholder="url">
                    <span class="help-block" v-show="errors.url">{{ errors.url }}</span>
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