<section>
    <div class="row">
        <div class="col-lg-12">
            <div id="belt-app-pre-main">
                <div id="belt-work-requests-alerts"><!----></div>
            </div>

            <div id="belt-content">
                <div>
                    <div>
                        <section class="content-header">
                            <ol class="breadcrumb">
                                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li><a href="/admin/belt/content/attachments" class="router-link-exact-active router-link-active">Attachment Manager</a></li>
                            </ol>
                            <h1><span>Attachment Manager</span>
                                <small></small>
                                <span class="pull-right"><span><span class="pull-right"><a href="/tbd" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
                        </section>
                    </div>
                    <section class="content">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="filter-set clearfix">
                                    <div class="pull-left"><span><div class="form-group filter pull-left"><label>Filter <!----></label> <div class="form-group"><div class="input-group"><input placeholder="filter" class="form-control"> <!----></div></div></div></span></div>
                                    <div class="pull-left"><span><div class="form-group filter pull-left"><label>Type</label> <div class="form-group"><select title="item type" class="form-control"><option value=""></option> <option value="default">default</option></select></div></div></span></div>
                                    <div class="pull-right">
                                        <div class="btn-group">
                                            <div>
                                                <div class="file-group"><label for="file"><label for="my-file-selector" title="upload file" class="btn btn-primary"><input type="file" name="file" id="file-uploader" accept="image/*,application/pdf,text/plain" multiple="multiple" style="display: none;"> add attachment</label> <!----> </label>
                                                    <button type="button" class="btn btn-default hide">upload</button>
                                                </div> <!----> <!----></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                ID
                                                <span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by attachments.id"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <th>
                                                Type
                                                <span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by posts.subtype"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <td></td>
                                            <th>
                                                Name
                                                <span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by attachments.original_name"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <th>
                                                Title
                                                <span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by attachments.title"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <th>Created<span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by attachments.created_at"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <th>Updated<span><span class="belt-column-sorter pull-right asc"><a href="" title="sort by attachments.updated_at"><i class="fa fa-arrows-v"></i> <i class="fa fa-sort-amount-asc"></i> <i class="fa fa-sort-amount-desc"></i></a></span></span></th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/business1.jpg" class=""></td>
                                            <td>business1.jpg</td>
                                            <td>culpa rerum molestiae vel labore voluptatem veniam</td>
                                            <td>2019-01-31 21:32:38</td>
                                            <td>2019-01-31 21:32:38</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/1" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/people1.jpg" class=""></td>
                                            <td>people1.jpg</td>
                                            <td>aut id consequatur non iure omnis</td>
                                            <td>2019-01-31 21:32:38</td>
                                            <td>2019-01-31 21:32:38</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/2" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/5886d1e6f339792b2c559c07ab4d3911.jpg" class=""></td>
                                            <td>5886d1e6f339792b2c559c07ab4d3911.jpg</td>
                                            <td>ducimus nobis ducimus rerum eaque</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/3" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/ffc1a8e8a8529462f75094fe6d4c92c4.jpg" class=""></td>
                                            <td>ffc1a8e8a8529462f75094fe6d4c92c4.jpg</td>
                                            <td>harum eius et quo repellendus nihil incidunt</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/4" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/c86466e3c3180e7c89a115de29d48b0d.jpg" class=""></td>
                                            <td>c86466e3c3180e7c89a115de29d48b0d.jpg</td>
                                            <td>animi consequuntur officia</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/5" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/ee875e87e5df8398dc19db1d4d71b8df.jpg" class=""></td>
                                            <td>ee875e87e5df8398dc19db1d4d71b8df.jpg</td>
                                            <td>praesentium ut magni in autem</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/6" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/60657e61e572522bcf83cd80d5eb536f.jpg" class=""></td>
                                            <td>60657e61e572522bcf83cd80d5eb536f.jpg</td>
                                            <td>rem voluptatibus sunt ullam velit quae</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/7" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/5886d1e6f339792b2c559c07ab4d3911.jpg" class=""></td>
                                            <td>5886d1e6f339792b2c559c07ab4d3911.jpg</td>
                                            <td>quidem vero eaque perferendis architecto</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/8" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/ffc1a8e8a8529462f75094fe6d4c92c4.jpg" class=""></td>
                                            <td>ffc1a8e8a8529462f75094fe6d4c92c4.jpg</td>
                                            <td>est officia eaque dolor</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/9" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>default</td>
                                            <td><img src="http://2.0.larabelt.test/storage/local/uploads/c86466e3c3180e7c89a115de29d48b0d.jpg" class=""></td>
                                            <td>c86466e3c3180e7c89a115de29d48b0d.jpg</td>
                                            <td>voluptatem quas voluptas esse quidem dignissimos</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td>2019-02-06 14:16:46</td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    <button type="button" data-toggle="dropdown" aria-expanded="false" title="options" class="btn btn-xs btn-default dropdown-toggle text-muted"><i class="fa fa-gear"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a class="modal-delete-trigger ''"><i class="fa fa-trash"></i> Remove</a></li>
                                                    </ul>
                                                    <a href="/admin/belt/content/attachments/edit/10" class="btn btn-xs btn-default" title="edit attachment"><i class="fa fa-edit"></i></a></div>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div>
                                    <div class="row belt-pagination">
                                        <div class="col-md-4">
                                            <div role="status" aria-live="polite" class="pagination">
                                                Showing 1 to 10 of 27 entries
                                            </div>
                                        </div>
                                        <div class="col-md-8"><span class="pull-right"><ul class="pagination-sm pagination"><li class="disabled"><span><i title="first page" class="fa fa-step-backward"></i></span></li> <li class="disabled"><span><i title="previous page" class="fa fa-backward"></i></span></li> <li class="active"><a href="" title="page 1">1</a></li><li class=""><a href=""
                                                                                                                                                                                                                                                                                                                                                                                             title="page 2">2</a></li><li
                                                            class=""><a href="" title="page 3">3</a></li> <li><a href="" title="next page"><i class="fa fa-forward"></i></a></li> <li><a href="" title="last page"><i class="fa fa-step-forward"></i></a></li></ul></span> <span class="pull-right"><div class="form-inline"><div class="form-group"><select title="items per page" class="form-control"
                                                                                                                                                                                                                                                                                                                                                             style="height: 30px;"><option value="">show 10 items</option> <option
                                                                    value="10">10 items</option><option value="50">50 items</option><option value="100">100 items</option><option value="500">500 items</option><option value="1000">1000 items</option></select></div></div></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</section>