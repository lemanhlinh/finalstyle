@extends('admin.layouts.admin')

@section('title_file', trans('form.article.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.article.store') }}" method="POST">
            @csrf
            @include('admin.article.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
{{--        <button id="ckfinder-popup" class="button-a button-a-background" style="float: left">Open Popup</button>--}}
    </div>
@endsection

@section('script')
    @parent
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
    <script>
        // var button = document.getElementById( 'ckfinder-popup' );
        //
        // button.onclick = function() {
        //     CKFinder.popup( {
        //         chooseFiles: true,
        //         width: 800,
        //         height: 600,
        //         onInit: function( finder ) {
        //             finder.on( 'files:choose', function( evt ) {
        //                 var file = evt.data.files.first();
        //                 var output = document.getElementById( 'output' );
        //                 output.innerHTML = 'Selected: ' + escapeHtml( file.get( 'name' ) ) + '<br>URL: ' + escapeHtml( file.getUrl() );
        //             } );
        //
        //             finder.on( 'file:choose:resizedImage', function( evt ) {
        //                 var output = document.getElementById( 'output' );
        //                 output.innerHTML = 'Selected resized image: ' + escapeHtml( evt.data.file.get( 'name' ) ) + '<br>url: ' + escapeHtml( evt.data.resizedUrl );
        //             } );
        //         }
        //     } );
        // };
    </script>
@endsection

