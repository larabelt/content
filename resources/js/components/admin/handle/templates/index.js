export default `
    <div>
        <section class="content-header">
            <h1>Handle Manager <small></small></h1>
        </section>
        <div class="box box-primary">
        <div class="box-body">
            <div class="btn-group">
                <router-link to="/handles/create" v-bind:class="'btn btn-primary'">add handle</router-link>
            </div>
            <table class="table table-bordered table-hover">
            
                <thead>
                    <tr>
                        <th>
                            ID
                            <column-sorter :routeurl="'handleIndex'" :order-by="'handles.id'"></column-sorter>
                        </th>
                        <th>
                            Url
                            <column-sorter :routeurl="'handleIndex'" :order-by="'handles.url'"></column-sorter>
                        </th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
    
                <tbody>                
                    <tr v-for="item in items.data.data">
                        <td>{{ item.id }}</td>
                        <td>{{ item.url }}</td>
                        <td class="text-right">
                            <router-link :to="{ name: 'handleEdit', params: { id: item.id } }" v-bind:class="'btn btn-xs btn-warning'">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a class="btn btn-xs btn-danger" v-on:click="destroy(item.id)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Url</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </tfoot>
                
            </table>
            <div class="row">
                <div class="col-xs-5">
                    <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ items.data.from }} to {{ items.data.to }} of {{ items.data.total }} entries
                    </div>
                </div>
                <div class="col-xs-7">
                    <pagination :routeurl="'handleIndex'"></pagination>
                </div>
            </div>
        </div>
    </div>
    </div>
`;