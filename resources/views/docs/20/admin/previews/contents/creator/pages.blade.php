<div>
    <div>
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/belt/content/pages" class="router-link-active">Page Manager</a></li>
                <li>Page Creator</li>
            </ol>
            <h1><span>Page Creator</span>
                <small></small>
                <span class="pull-right"><span><span class="pull-right"><a href="/docs/2.0/admin/content/overview#pages" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
        </section>
    </div>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <form class="translatable">
                    <div class="clearfix" style="margin-bottom: 10px;">
                        <div class="pull-left">
                            <div class="btn-group"><!----></div>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group"> <!---->
                                <button class="btn btn-sm btn-primary"><span>save</span></button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group"><label for="subtype">Type</label> <select name="subtype" class="form-control">
                                <option value="default">default</option>
                                <option value="form">Form</option>
                                <option value="custom">custom</option>
                                <option value="example">example</option>
                                <option value="no-cache">no-cache</option>
                            </select></div>
                    </div>
                    <span><input type="hidden" value="false"> <button class="btn btn-xs btn-default" style="margin-bottom: 10px;"><i class="fa fa-square-o"></i></button> Is Active</span>
                    <div class="form-group"><label for="name">Name <span>*</span></label> <input type="text" placeholder="" class="form-control"> <span class="help-block"></span>  <!----></div> <!----> <!---->
                    <div class="panel panel-default bg-gray group-seo-meta">
                        <div class="panel-heading"><h3 class="panel-title">
                                Meta Data
                                <span class="pull-right"><i class="fa fa-plus"></i></span></h3></div>
                        <div class="panel-footer">Meta data is the key words and phrases that describe the contents of the page for search results and search engine indexing.</div>
                        <div class="panel-body">
                            <div class="form-group"><label for="meta_title">Meta Title
                                    <!----></label> <input type="text" placeholder="meta title" class="form-control"> <span class="help-block"></span>  <!----></div>
                            <div class="form-group"><label>Meta Description
                                    <!----></label> <textarea rows="10" class="form-control"></textarea> <span class="help-block"></span>  <!----></div>
                            <div class="form-group"><label>Meta Keywords
                                    <!----></label> <textarea rows="10" class="form-control"></textarea> <span class="help-block">Please format your keyword list with commas separating words. Ex. summer, beach, waves.</span>  <!----></div>
                        </div>
                    </div>
                    <div class="clearfix" style="margin-bottom: 10px;">
                        <div class="pull-left">
                            <div class="btn-group"><!----></div>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group"> <!---->
                                <button class="btn btn-sm btn-primary"><span>save</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>