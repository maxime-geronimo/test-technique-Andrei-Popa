@extends('base')

@section('title', 'Picture Test')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            @if(null !== $default)
                <img class="img-fluid"
                     src="{{ url((config('image.display_path') . DIRECTORY_SEPARATOR . $default->name)) }}">
            @else
                <h4>It looks like you don't have any pictures uploaded for now.</h4>
                <h4>Or you haven't yet chosen a default one.</h4>
            @endif
        </div>
        <div class="col-lg-4 offset-lg-1">
            @if(Session::has('success') && Session::get('success') == true)
                <h6>File upload successful</h6>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ action('ImageController@uploadProcess') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <input name="file_input" type="file" class="form-control-file" id="file_input"
                               aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Supported file types: JPG, PNG, GIF.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>

    @foreach ($images->chunk(3) as $chuck)
        <div class="row">
            @foreach($chuck as $image)
                <div class="col-xs-4">
                    <a href="{{route('edit', ['id' => $image->id])}}" class="thumbnail">
                        <img class="img-fluid"
                             src="{{ url((config('image.display_path') . DIRECTORY_SEPARATOR . $image->name)) }}">
                    </a>
                    <a href="{{route('setDefault', ['id' => $image->id])}}" class="btn btn-primary btn-lg btn-block">Set as default</a>
                </div>

            @endforeach
        </div>
    @endforeach

    <div class="row">
        <div class="col-lg-12 text-xs-center">
            {{ $pagination }}
        </div>
    </div>
@endsection
