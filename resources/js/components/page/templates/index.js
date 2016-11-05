export default `
    <div class="box box-primary">
        <div class="box-body">
            <div class="btn-group">
                <router-link to="/pages/create" v-bind:class="'btn btn-primary'">add page</router-link>
            </div>
            <table class="table table-bordered table-hover">
            
                <thead>
                    <tr>
                        <th>
                            ID
                            <column-sorter :routename="'pageIndex'" :order-by="'pages.id'"></column-sorter>
                        </th>
                        <th>
                            Name
                            <column-sorter :routename="'pageIndex'" :order-by="'pages.name'"></column-sorter>
                        </th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
    
                <tbody>                
                    <tr v-for="item in items.data.data">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-right">
                            <router-link :to="{ name: 'pageEdit', params: { id: item.id } }" v-bind:class="'btn btn-xs btn-warning'">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a class="btn btn-xs btn-danger" v-on:click="destroy(item.id)"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
                    <pagination :routename="'pageIndex'"></pagination>
                </div>
            </div>
        </div>
    </div>
`;