@extends('admin.layouts.admin')
@section('link')
    @parent
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
@endsection
@section('title_file', trans('form.article_category.manage'))

@section('content')
    <a href="{{ route('admin.article-category.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> @lang('form.button.create')</a>
    {!! $dataTable->table(['id' => 'article-table', 'class' => 'table table-striped table-bordered table-width-auto']) !!}
    <div class="row hidden">
        @foreach($categories as $shop)
            <div class="col-md-12">
                <h3>{{ $shop->name }}</h3>
                <hr />
                <div class="row">
                    @foreach($shop->children as $cats)
                        <div class="col-md-4">
                            <h4>{{ $cats->name }}</h4>
                            <hr />
                            @foreach($cats->children as $cat)
                                <h5>{{$cat->name}}</h5>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div>
        <div class="dd" data-url="{{ route('admin.article-category.updateTree') }}">
            <ol class="dd-list">
                @foreach ($categories as $shop)
                    @include('admin.article-category.item', ['item'=>$shop])
                @endforeach
            </ol>
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
    <script>
        let dd = $('.dd')
        let base = $('#base').val()
        dd.nestable({  }).on('change', function(){
            let dataOutput = dd.nestable('serialize')
            try {
                $.ajax({
                    type: "post",
                    url: dd.data('url'),
                    data: {
                        data: dataOutput,
                        _token : $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            } catch (error) {
                console.log(error);
            }
        })
    </script>
    {!! $dataTable->scripts() !!}
@endsection
