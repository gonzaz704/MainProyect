@extends('layouts.papers')

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <fieldset class="paper-fieldset">
                <legend class="paper-legend">Filter Papers</legend>
                <form method="POST" id="papers-filter" action="{{ route('papers.filter') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="tags">@lang('PapersCreate.Tags')</label>
                                <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                                    @foreach($tags as $tag)
                                    @if($tag->is_papers_tags)
                                        <option value="{{ $tag->id}}">{{ $tag->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="link_investigacion">Country</label>
                                @include('auth.partials.country',['value' => request()->query('country')])
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="link_investigacion">Author</label>
                                <select name="user_id" class="form-control" id="user_id" value="">
                                    <option value="">Choose Authors</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <button class="btn btn-default">Filter</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <div class="col-sm-8">
            <fieldset class="paper-fieldset">
                <legend class="paper-legend">Create a discussion</legend>
                <form method="POST" action="{{ route('papers.discuss.submit', ['id' => $model->id]) }}"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group" style="margin-top:10px;margin-bottom:10px;">
                            <div class="col-sm-12">
                                <label for="topic">Select Papers</label>
                                <select name="papers[]" class="tag-selector" id="news-data-papers" multiple="multiple"
                                    required>
                                    @foreach ($papers as $paper)
                                        <option value="{{ $paper->id }}">{{ $paper->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group" style="margin-top:10px">
                        <label for="topic">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="editor">Description</label>
                        <textarea type="text" class="form-control" id="editor" name="description"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-default" style="margin-top:10px;">Send</button>
                </form>
            </fieldset>
        </div>
    </div>


@endsection
