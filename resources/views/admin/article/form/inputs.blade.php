<div class="row">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.article.title')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="title" value="{{ isset($article) ? $article->title : old('title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.article.slug')</label> <span class="text-danger">(@lang('form.auto_slug'))</span>
            <input type="text" class="form-control" name="slug" value="{{ isset($article) ? $article->slug : old('slug') }}">
            @if ($errors->has('slug'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <!-- text input -->
        <div class="form-group clearfix">
            <label>@lang('form.article.status')</label> <span class="text-danger">*</span>
            <div class="form-group">
                <div class="icheck-success d-inline">
                    <input class="" type="radio" id="statusRadio1" name="status" value="{{ \App\Models\Article::STATUS_ACTIVE }}" {{ isset($article->status) && $article->status == \App\Models\Article::STATUS_ACTIVE ? 'checked' : '' }} required>
                    <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="icheck-danger d-inline">
                    <input class="" type="radio" id="statusRadio2" name="status" value="{{ \App\Models\Article::STATUS_INACTIVE }}" {{ isset($article->status) && $article->status == \App\Models\Article::STATUS_INACTIVE ? 'checked' : '' }} required>
                    <label for="statusRadio2" class="custom-control-label">@lang('form.status.inactive')</label>
                </div>
            </div>
            @if ($errors->has('status'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.article.date')</label> <span class="text-danger">*</span>
            <input type="date" class="form-control" name="date" value="{{ isset($article) ? $article->date : old('date') }}">
            @if ($errors->has('slug'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.article.category')</label> <span class="text-danger">*</span>
            <select name="category_id" id="category_id" class="form-control">
                @forelse($categories as $key => $category)
                    <option value="{{ $key }}" {{ isset($article->category_id) && $article->category_id == $key ? 'selected' : old('category_id') == $key ? 'selected' : '' }}>{{ $category }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
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
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.content')</label>
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($article->content) ? $article->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
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
