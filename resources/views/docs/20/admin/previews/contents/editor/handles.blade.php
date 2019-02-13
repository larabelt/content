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
                                <li><a href="/admin/belt/content/handles" class="router-link-active">Handle Manager</a></li>
                                <li>/some/newpage</li>
                            </ol>
                            <h1><span>Handle Editor</span>
                                <small></small>
                                <span class="pull-right"><span><span class="pull-right"><a href="/tbd" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
                        </section>
                    </div>
                    <section class="content">
                        <div class="box">
                            <div class="box-body">
                                <form _lpchecked="1">
                                    <div class="radio"><label><input type="radio" name="is_active" value="1">
                                            Is active
                                            <small>no action is required</small>
                                        </label></div>
                                    <div class="radio"><label><input type="radio" name="is_active" value="0">
                                            Is not active
                                        </label></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="template">Response Type</label> <select name="template" class="form-control">
                                                    <option value="alias">Alias (show associated item, no redirection)</option>
                                                    <option value="not-found">Not Found (show 404 page, no redirection)</option>
                                                    <option value="permanent-redirect">Permanent Redirect</option>
                                                    <option value="temporary-redirect">Temporary Redirect</option>
                                                </select></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="radio"><label><input type="radio" name="is_default" value="0">
                                                    This is <strong>not</strong> the default handle for the associated item
                                                </label></div>
                                            <div class="radio"><label><input type="radio" name="is_default" value="1">
                                                    This is the default handle for the associated item
                                                </label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"><label for="url">Url *</label> <input placeholder="url" class="form-control"></div>
                                        </div>
                                        <div class="col-md-6"><!----></div>
                                    </div>
                                    <div class="form-group"><label>Associated Item *</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form class="form-inline" style="margin-bottom: 20px;">
                                                    <div class="form-group">
                                                        <div class="input-group"><input placeholder="search" class="form-control">
                                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-default">clear</button>
                                                </form>
                                            </div>
                                            <div class="col-md-8"><!----></div>
                                            <div class="col-md-12"><!----></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-primary"><span>save</span></button>
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