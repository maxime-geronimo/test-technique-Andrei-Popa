@extends('base')

@section('title', 'Edit Picture')

@section('content')
    <div class="row" >
        <div class="col-lg-12">
            <img class="img-fluid"
             src="{{ url((config('image.display_path') . DIRECTORY_SEPARATOR . $image->name)) }}">
        </div>
    </div>


    <div class="row" >
        <div class="col-lg-12 text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-lg-12 text-center">
            @if(Session::has('success') && Session::get('success') == true)
                <p class="text-info">File edited successfully</p>
            @endif
        </div>

        <div class="col-lg-12">
            <form method="POST" action="{{ action('ImageController@editProcess', ['id' => $image->id]) }}">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label for="file_description">Description</label>
                        <input type="text" class="form-control" id="file_description" name="file_description" placeholder="Enter description" value="{{ $image->description }}">
                    </div>

                    <div class="form-group">
                        <label for="file_title">Title</label>
                        <input type="text" class="form-control" id="file_description" name="file_title" placeholder="Enter title" value="{{ $image->title }}">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
