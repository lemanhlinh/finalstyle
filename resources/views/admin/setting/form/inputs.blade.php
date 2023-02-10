<div class="row">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.setting.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="key" value="{{ isset($article) ? $article->name : old('name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.setting.key')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="key" value="{{ isset($article) ? $article->key : old('key') }}">
            @if ($errors->has('key'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('key') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <select name="type" class="form-control" required>
            <option value="" hidden>@lang('form.order.type')</option>
            @forelse(\App\Constants\TypeQuestionConstant::TYPE as $key => $type)
                <option value="{{ $key }}" @if($q->type == $key) selected @endif>{{ $type }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.article.image')</label> <span class="text-danger">*</span>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image"
                           value="{{ isset($article->image) ? $article->image : old('image') }}">
                    <label class="custom-file-label" for="image">Choose file</label>
                    <span id="output"></span>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
            @if(isset($article->image) && $article->image != null)
                <img src="{{ asset($article->image) }}" width="200px" alt="">
            @endif
            @if ($errors->has('image'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ), {
                ckfinder: {
                    uploadUrl: '{{route('ckfinder_connector')}}?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( 'Oops, something went wrong!' );
                console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
                console.warn( 'Build id: mrtoviz9w3mq-smtjaa3191gp' );
                console.error( error );
            } );
    </script>
    @include('ckfinder::setup')
@endsection
