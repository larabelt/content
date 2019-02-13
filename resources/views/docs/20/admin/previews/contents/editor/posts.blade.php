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
                                <li><a href="/admin/belt/content/posts" class="router-link-active">Post Manager</a></li>
                                <li>Quo Omnis Quo</li>
                            </ol>
                            <h1><span>Post Editor</span>
                                <small></small>
                                <span class="pull-right"><span><span class="pull-right"><a href="/tbd" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
                        </section>
                    </div>
                    <section class="content">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="/admin/belt/content/posts/edit/1" class="router-link-exact-active router-link-active"><span class="hidden-sm hidden-xs">Main</span> <i class="fa fa-home visible-sm visible-xs"></i></a></li> <!---->
                                <li class=""><a href="/admin/belt/content/posts/edit/1/handles" class="">Handles</a></li>
                                <li class=""><a href="/admin/belt/content/posts/edit/1/attachments" class=""><span class="hidden-sm hidden-xs">Attachments</span> <i class="fa fa-file-o visible-sm visible-xs"></i></a></li>
                                <li class=""><a href="/admin/belt/content/posts/edit/1/terms" class=""><span class="hidden-sm hidden-xs">Terms</span> <i class="fa fa-sitemap visible-sm visible-xs"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <div class="btn-group sub-tab-btn-group"><a target="_blank" href="/posts/1" class="btn btn-xs btn-default">preview</a></div>
                                    </div>
                                </div>
                                <form>
                                    <div class="clearfix" style="margin-bottom: 10px;">
                                        <div class="pull-left">
                                            <div class="btn-group"><!----></div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary"><span>save</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group"><label for="subtype">Type</label> <select name="subtype" class="form-control">
                                                <option value="default">default</option>
                                                <option value="no-cache">no-cache</option>
                                            </select></div>
                                    </div>
                                    <span><input type="hidden" value="1"> <button class="btn btn-xs btn-primary" style="margin-bottom: 10px;"><i class="fa fa-check-square-o"></i></button> Is Active</span>
                                    <div class="form-group"><label for="name">Name <span>*</span></label> <input type="text" placeholder="" class="form-control"
                                                                                                                 style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                        <span class="help-block"></span>  <!----></div>
                                    <div class="form-group"><label for="slug">Slug <!----></label> <input type="text" placeholder="" class="form-control"> <span class="help-block"></span>  <!----></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="source_name">Source Name</label> <input placeholder="source name" class="form-control"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="source_url">Source Url</label> <input placeholder="source url" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label>Post At</label>
                                                <div class="form-inline">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                        <input type="date" name="post_at_date" class="form-control"></div>
                                                    <div class="input-group date"><input type="time" name="post_at_time" class="form-control"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-primary"><span>save</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</section>