@extends('base')

@section('title', 'Picture Test')

@section('content')
    <div class="row top-buffer">
        <div class="col-lg-5">
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
                <fieldset class="text-center">
                    <div class="form-group">
                        <input name="file_input" type="file" class="form-control-file padding-buffer" id="file_input"
                               aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Supported file types: JPG, PNG, GIF.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Upload</button>
                </fieldset>
            </form>
        </div>

        <div class="col-lg-6 offset-lg-1">
            @if(null !== $default)
                <img class="img-fluid border-black"
                     src="{{ url((config('image.display_path') . DIRECTORY_SEPARATOR . $default->name)) }}">
            @else
                <h4>No default image chosen</h4>
            @endif
        </div>

    </div>

    @foreach ($images->chunk(3) as $chuck)
        <div class="row">
            @foreach($chuck as $image)
                <div class="col-lg-4">
                    <a href="{{route('edit', ['id' => $image->id])}}" class="thumbnail">
                        <img class="img-fluid"
                             src="{{ url((config('image.display_path') . DIRECTORY_SEPARATOR . $image->name)) }}">
                    </a>
                    <a href="{{route('setDefault', ['id' => $image->id])}}" class="btn btn-primary btn-lg btn-block">Set as default</a>
                </div>

            @endforeach
        </div>
    @endforeach

    <div class="row top-buffer">
        <div class="col-lg-12 center">
            @if ($images->lastPage() > 1)
                <ul class="pagination ml-auto">
                    <li class="{{ ($images->currentPage() == 1) ? ' disabled' : '' }} page-item">
                        <a class=" page-link " href="{{ $images->url(1) }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $images->lastPage(); $i++)
                        <li class="{{ ($images->currentPage() == $i) ? ' active' : '' }} page-item">
                            <a class=" page-link " href="{{ $images->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="{{ ($images->currentPage() == $images->lastPage()) ? ' disabled' : '' }} page-item">
                        <a href="{{ $images->url($images->currentPage()+1) }}" class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
@endsection
