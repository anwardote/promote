<div class="modal fade" id="contentBuilderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="active"><a href="#red" data-toggle="tab">Media Library</a></li>
                        <li><a href="#orange" data-toggle="tab">User Uploads</a></li>
                    </ul>
                    <div id="search">
                        <div class="form-group">
                            {!! Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'Type something']) !!}
                        </div>
                    </div>
                    <div id="my-tab-content" class="tab-content"></div>
                </div>
            </div>
        </div>
    </div>
</div>
