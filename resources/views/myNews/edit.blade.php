@extends('layouts.main')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between mb-2">
            <div class="col align-self-center">
                <h3>Edit News</h3>
            </div>
            <div class="col align-self-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="row">
            <form method="POST" action="{{ route('my-news.update', $news->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group col-sm-12">
                    <label for="slug">Source</label>
                    <select name="source_id" id="source_id" class="form-control" required>
                        <option value="">Select Any One</option>
                        @foreach ($sources as $source)
                            <option value="{{ $source['id'] }}" {{ $news->source == $source['id'] ? 'selected' : '' }}>
                                {{ $source['title'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-8">
                    <label for="name">Url</label>
                    <input type="text" id="url" class="form-control" name="url" value="{{ $news->url }}"
                        required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-secodary" id="fetch-button" type="button">Fetch</button>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Title</label>
                    <input type="text" id="title" class="form-control" name="title" value="{{ $news->title }}"
                        required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Description</label>
                    <input type="text" id="description" class="form-control" name="description"
                        value="{{ $news->description }}" required>
                </div>
                <div class="form-group col-sm-12">
                    <label for="name">Image Url</label>
                    <input type="text" id="image" class="form-control" name="image" value="{{ $news->image }}">
                </div>
                <div class="row mt-1 ml-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js_scripts')
    <script>
        $(document).ready(function() {
            console.log('script is runing');
            $('#fetch-button').on('click', function() {
                var url = $('#url').val();
                if (url) {
                    $.ajax({
                        url: "{{ url('retrive-metadata-from-url') }}?url=" + url,
                        method: 'get',
                        success: function(res) {
                            if (res['og:title']) {
                                $('#title').val(res['og:title']);
                            }
                            if (res['og:description']) {
                                $('#description').val(res['og:description']);
                            }
                            if (res['og:image']) {
                                $('#image').val(res['og:image']);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
