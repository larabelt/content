export default `
    <div class="box box-primary">
        <div class="box-body">
            <div class="btn-group">
                <router-link to="/blocks/create" v-bind:class="'btn btn-primary'">add block</router-link>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            ID
                            <column-sorter :routename="'blockIndex'" :order-by="'blocks.id'"></column-sorter>
                        </th>
                        <th>
                            Name
                            <column-sorter :routename="'blockIndex'" :order-by="'blocks.name'"></column-sorter>
                        </th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>                
                    <tr v-for="item in items.data">
                        <td>{{ item.id }}</td>
                        <td>{{ item.name }}</td>
                        <td class="text-right">
                            <router-link :to="{ name: 'blockEdit', params: { id: item.id } }" v-bind:class="'btn btn-xs btn-warning'">
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
            <pagination :routename="'blockIndex'"></pagination>
        </div>
    </div>
`;