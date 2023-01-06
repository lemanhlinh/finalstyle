<div class="row">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.user.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ isset($article_category) ? $article_category->name : old('name') }}" required>
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
            <label>@lang('form.user.slug')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="slug" value="{{ isset($article_category) ? $article_category->slug : old('slug') }}" required>
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
            <label>@lang('form.article-category.image')</label>
            <input type="file" class="form-control" name="image"
                   value="{{ isset($article_category->image) ? $article_category->image : old('image') }}">
            @if(isset($article_category->image) && $article_category->image != null)
                <img src="{{ asset($article_category->image) }}" width="200px" alt="">
            @endif
            @if ($errors->has('image'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
