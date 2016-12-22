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
                    <tr v-for="page in pages.pages">
                        <td>{{ page.id }}</td>
                        <td>{{ page.name }}</td>
                        <td class="text-right">
                            <router-link :to="{ name: 'pageEdit', params: { id: page.id } }" v-bind:class="'btn btn-xs btn-warning'">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a class="btn btn-xs btn-danger" v-on:click="destroyPage(page.id)"><i class="fa fa-trash"></i></a>
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
            <pagination :routename="'pageIndex'"></pagination>
        </div>
    </div>
`;