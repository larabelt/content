<div>
    <div>
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="/admin/belt/content/pages" class="router-link-active">Page Manager</a></li>
                <li>Home</li>
            </ol>
            <h1><span>Page Editor</span>
                <small></small>
                <span class="pull-right"><span><span class="pull-right"><a href="/docs/2.0/admin/content/overview#pages" target="_blank"><i class="fa fa-question-circle"></i></a></span></span></span></h1>
        </section>
    </div>
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="/admin/belt/content/pages/edit/1" class="router-link-exact-active router-link-active"><span class="hidden-sm hidden-xs">Main</span> <i class="fa fa-home visible-sm visible-xs"></i></a></li> <!---->
                <li class=""><a href="/admin/belt/content/pages/edit/1/terms" class=""><span class="hidden-sm hidden-xs">Terms</span> <i class="fa fa-sitemap visible-sm visible-xs"></i></a></li>
                <li class=""><a href="/admin/belt/content/pages/edit/1/handles" class=""><span class="hidden-sm hidden-xs">Handles</span> <i class="fa fa-link visible-sm visible-xs"></i></a></li>
                <li class=""><a href="/admin/belt/content/pages/edit/1/attachments" class=""><span class="hidden-sm hidden-xs">Attachments</span> <i class="fa fa-file-o visible-sm visible-xs"></i></a></li>
            </ul>
            <div class="tab-content">
                <form class="translatable" morphable="[object Object]" entity_id="1" entity_type="pages">
                    <div class="clearfix" style="margin-bottom: 10px;">
                        <div class="pull-left">
                            <div class="btn-group"><!----></div>
                        </div>
                        <div class="pull-right">
                            <div class="btn-group"><a target="_blank" href="/pages/1" class="btn btn-sm btn-default">preview</a>
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
                    <span><input type="hidden" value="true"> <button class="btn btn-xs btn-primary" style="margin-bottom: 10px;"><i class="fa fa-check-square-o"></i></button> Is Active</span>
                    <div class="form-group"><label for="name">Name <span>*</span></label> <input type="text" placeholder="" class="form-control"
                                                                                                 style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                        <span class="help-block"></span>  <!----></div>
                    <div class="form-group"><label for="slug">Slug <!----></label> <input type="text" placeholder="" class="form-control"> <span class="help-block"></span>  <!----></div>
                    <div><!---->
                        <div>
                            <div class="form-group"><label>Body</label>
                                <div class="tinymce" form="[object Object]">
                                    <div id="mceu_18" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 100%;">
                                        <div id="mceu_18-body" class="mce-container-body mce-stack-layout">
                                            <div id="mceu_19" class="mce-top-part mce-container mce-stack-layout-item mce-first">
                                                <div id="mceu_19-body" class="mce-container-body">
                                                    <div id="mceu_20" class="mce-container mce-menubar mce-toolbar mce-first" role="menubar" style="border-width: 0px 0px 1px;">
                                                        <div id="mceu_20-body" class="mce-container-body mce-flow-layout">
                                                            <div id="mceu_21" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-first mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_21" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_21-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">File</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_22" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_22" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_22-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Edit</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_23" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_23" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_23-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">View</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_24" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_24" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_24-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Insert</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_25" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_25" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_25-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Format</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_26" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_26" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_26-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Tools</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                            <div id="mceu_27" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-last mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_27" role="menuitem" aria-haspopup="true">
                                                                <button id="mceu_27-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Table</span> <i class="mce-caret"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="mceu_28" class="mce-toolbar-grp mce-container mce-panel mce-last" hidefocus="1" tabindex="-1" role="group">
                                                        <div id="mceu_28-body" class="mce-container-body mce-stack-layout">
                                                            <div id="mceu_29" class="mce-container mce-toolbar mce-stack-layout-item mce-first mce-last" role="toolbar">
                                                                <div id="mceu_29-body" class="mce-container-body mce-flow-layout">
                                                                    <div id="mceu_30" class="mce-container mce-flow-layout-item mce-first mce-btn-group" role="group">
                                                                        <div id="mceu_30-body">
                                                                            <div id="mceu_0" class="mce-widget mce-btn mce-first mce-disabled" tabindex="-1" role="button" aria-label="Undo" aria-disabled="true">
                                                                                <button id="mceu_0-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-undo"></i></button>
                                                                            </div>
                                                                            <div id="mceu_1" class="mce-widget mce-btn mce-last mce-disabled" tabindex="-1" role="button" aria-label="Redo" aria-disabled="true">
                                                                                <button id="mceu_1-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-redo"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_31" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_31-body">
                                                                            <div id="mceu_2" class="mce-widget mce-btn mce-menubtn mce-first mce-last" tabindex="-1" aria-labelledby="mceu_2" role="button" aria-haspopup="true">
                                                                                <button id="mceu_2-open" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-insert"></i> <i class="mce-caret"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_32" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_32-body">
                                                                            <div id="mceu_3" class="mce-widget mce-btn mce-menubtn mce-first mce-last mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_3" role="button" aria-haspopup="true">
                                                                                <button id="mceu_3-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Formats</span> <i class="mce-caret"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_33" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_33-body">
                                                                            <div id="mceu_4" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Bold">
                                                                                <button id="mceu_4-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bold"></i></button>
                                                                            </div>
                                                                            <div id="mceu_5" class="mce-widget mce-btn mce-last" tabindex="-1" aria-pressed="false" role="button" aria-label="Italic">
                                                                                <button id="mceu_5-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-italic"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_34" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_34-body">
                                                                            <div id="mceu_6" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Align left">
                                                                                <button id="mceu_6-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignleft"></i></button>
                                                                            </div>
                                                                            <div id="mceu_7" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align center">
                                                                                <button id="mceu_7-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-aligncenter"></i></button>
                                                                            </div>
                                                                            <div id="mceu_8" class="mce-widget mce-btn" tabindex="-1" aria-pressed="false" role="button" aria-label="Align right">
                                                                                <button id="mceu_8-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignright"></i></button>
                                                                            </div>
                                                                            <div id="mceu_9" class="mce-widget mce-btn mce-last" tabindex="-1" aria-pressed="false" role="button" aria-label="Justify">
                                                                                <button id="mceu_9-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignjustify"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_35" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_35-body">
                                                                            <div id="mceu_10" class="mce-widget mce-btn mce-splitbtn mce-menubtn mce-first" role="button" aria-pressed="false" tabindex="-1" aria-label="Bullet list" aria-haspopup="true">
                                                                                <button type="button" hidefocus="1" tabindex="-1"><i class="mce-ico mce-i-bullist"></i></button>
                                                                                <button type="button" class="mce-open" hidefocus="1" tabindex="-1"><i class="mce-caret"></i></button>
                                                                            </div>
                                                                            <div id="mceu_11" class="mce-widget mce-btn mce-splitbtn mce-menubtn" role="button" aria-pressed="false" tabindex="-1" aria-label="Numbered list" aria-haspopup="true">
                                                                                <button type="button" hidefocus="1" tabindex="-1"><i class="mce-ico mce-i-numlist"></i></button>
                                                                                <button type="button" class="mce-open" hidefocus="1" tabindex="-1"><i class="mce-caret"></i></button>
                                                                            </div>
                                                                            <div id="mceu_12" class="mce-widget mce-btn" tabindex="-1" role="button" aria-label="Decrease indent">
                                                                                <button id="mceu_12-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-outdent"></i></button>
                                                                            </div>
                                                                            <div id="mceu_13" class="mce-widget mce-btn mce-last" tabindex="-1" role="button" aria-label="Increase indent">
                                                                                <button id="mceu_13-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-indent"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_36" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_36-body">
                                                                            <div id="mceu_14" class="mce-widget mce-btn mce-first" tabindex="-1" aria-pressed="false" role="button" aria-label="Insert/edit link">
                                                                                <button id="mceu_14-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-link"></i></button>
                                                                            </div>
                                                                            <div id="mceu_15" class="mce-widget mce-btn mce-last" tabindex="-1" aria-pressed="false" role="button" aria-label="Insert/edit image">
                                                                                <button id="mceu_15-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-image"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_37" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
                                                                        <div id="mceu_37-body">
                                                                            <div id="mceu_16" class="mce-widget mce-btn mce-first mce-last" tabindex="-1" role="button" aria-label="Source code">
                                                                                <button id="mceu_16-button" role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-code"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="mceu_38" class="mce-container mce-flow-layout-item mce-last mce-btn-group" role="group">
                                                                        <div id="mceu_38-body">
                                                                            <div id="mceu_17" class="mce-widget mce-btn mce-first mce-last mce-btn-has-text" tabindex="-1" role="button">
                                                                                <button id="mceu_17-button" role="presentation" type="button" tabindex="-1"><span class="mce-txt">My button</span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="mceu_39" class="mce-edit-area mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;">
                                                <iframe id="mce_0_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help" style="width: 100%; height: 300px; display: block;"></iframe>
                                            </div>
                                            <div id="mceu_40" class="mce-statusbar mce-container mce-panel mce-stack-layout-item mce-last" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;">
                                                <div id="mceu_40-body" class="mce-container-body mce-flow-layout">
                                                    <div id="mceu_41" class="mce-path mce-flow-layout-item mce-first">
                                                        <div class="mce-path-item">&nbsp;</div>
                                                    </div>
                                                    <div id="mceu_42" class="mce-flow-layout-item mce-resizehandle"><i class="mce-ico mce-i-resize"></i></div>
                                                    <span id="mceu_43" class="mce-branding mce-widget mce-label mce-flow-layout-item mce-last"> Powered by <a href="https://www.tinymce.com/?utm_campaign=editor_referral&amp;utm_medium=poweredby&amp;utm_source=tinymce" rel="noopener" target="_blank" role="presentation" tabindex="-1">tinymce</a></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tinymce__init-area" id="mce_0" aria-hidden="true" style="display: none;"></div>
                                    <input type="hidden" name="mce_0"> <input name="" hidden="hidden"></div>
                                <span class="help-block">Enter main content of page here.</span>  <!----></div>
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
                            <div class="btn-group"><a target="_blank" href="/pages/1" class="btn btn-sm btn-default">preview</a>
                                <button class="btn btn-sm btn-primary"><span>save</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>