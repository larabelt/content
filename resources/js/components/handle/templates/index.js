export default `
    <div class="row">
        <div class="col-md-12">
            <form role="form" class="form-inline">
                <div class="box-body">
                    <div class="form-group" v-bind:class="{ 'has-error': errors.url }">
                        <input type="url" class="form-control" v-model.trim="item.url"  placeholder="url">
                        <span class="help-block" v-show="errors.url">{{ errors.url }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary" v-on:click="submit($event)">Add Handle</button>
                    <span v-show="saving">saving <i class="fa fa-spinner fa-spin" /></span>
                    <span v-show="saved">saved <i class="fa fa-floppy-o" /></span>
                </div>
            </form>
        </div>
        <div class="col-md-12">
           <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            Url
                            <column-sorter :column="'handles.url'"></column-sorter>
                        </th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>                
                    <tr v-for="handle in items">
                        <td>{{ handle.url }}</td>
                        <td class="text-right">
                            <a class="btn btn-xs btn-danger" v-on:click="destroy(handle.id)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination></pagination>
        </div>
    </div>
`;