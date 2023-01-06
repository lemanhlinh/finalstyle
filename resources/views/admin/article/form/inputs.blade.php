<div class="row">
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.user.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="display_name" value="{{ isset($article) ? $article->title : old('title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.user.name')</label> <span class="text-danger">*</span>
            <select name="category_id" id="category_id" class="form-control">
                @forelse($categories as $key => $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.kanji.content')</label>
            <div id="content" name="content" class="form-control" rows="10"></div>
            @if ($errors->has('content'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
</div>
