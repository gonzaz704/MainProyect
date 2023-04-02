@extends('layouts.papers')
@inject('tag_helper','App\Helpers\TagHelper')
@section('content') 
    <form method="POST" action="{{ url('edit-paper/'. $model->id) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PUT') }}
       <h2> Guide to write a summary paper:</h2></br> 
1 Make sure you have chosen a scientific paper and not another kind of literary production:
They are not allowed: Essays, monographies, persuasive research papers, news, blogs and any literary production without scientific method approach</br>
2 Identify your summary goals</br> 
3 Try to not copy exact words from the authors. You could not have enough space to do that</br>
3 Keep your summary brief</br>
4 Summaries are 1 or 2 paragraph long. Any longer than that you risk of an ineffective summary that's too long</br>
5 Some summaries can be even as short as one sentence </br>
6 Talk about the results and how significant they were. Briefly explain what the author's paper found and how conclusive the results were</br>  
7 Edit your summary for accuracy and flow. Check it for spelling errors or misinformation. Try to gauge how clear your writing is</br>
8 Now it is finished, go and show it to anyone that is not specialized in the topic you have written about, if they understand it, you have done a very good job</br></br></br>

        <div class="form-group">
            <label for="topic">@lang('PapersCreate.Author(name)')</label>
            <input type="text" class="form-control" id="topic" name="author_name" value="{{ $model->author_name }}" required>
        </div>
        <div class="form-group">
            <label for="topic">@lang('PapersCreate.Author(email)')</label>
            <input type="text" class="form-control" id="topic" name="author" value="{{ $model->author }}">
        </div>
        {{-- <div class="form-group">
            <label for="topic">@lang('PapersCreate.Topic')</label>
            <input type="text" class="form-control" id="topic" name="topic" value="{{ $model->topic }}" required>
        </div> --}}
        <div class="form-group">
            <label for="titulo">@lang('PapersCreate.Title')</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $model->titulo }}" required>
        </div>
        <div class="form-group">
            <label for="titulo">@lang('PapersCreate.Tutors-reviewers')</label>
            <input type="text" class="form-control" id="tutors" name="tutors" value="{{ $model->tutors }}" required>
        </div>
        <div class="form-group">
            <label for="tags">@lang('PapersCreate.Tags')</label>
            <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                @foreach($tag_helper->dropdown() as $tag)
                @if($tag->is_papers_tags)
                    <option {{ in_array($tag->id,$model->tags) ? 'selected' : null}} value="{{ $tag->id}}">{{ $tag->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="editor">@lang('PapersCreate.Abstract')</label>
            <textarea type="text" class="form-control" id="editor" name="abstract">{{ $model->abstract }}</textarea>
        </div>
        <br>

        <div class="form-group">
            <label for="ruta_grafico">@lang('PapersCreate.Charts')</label>
            <input type="file" class="form-control" id="ruta_grafico" name="charts[]" multiple>
            @if(is_array($model->ruta_grafico))
                @foreach($model->ruta_grafico as $image)
                    <div class="item">
                        <input type="hidden" name="old_charts[]" value="{{ $image }}">
                        <a href="{{ '/images/' . $image }}" target="_blank">{{ $image }}</a>
                        <button type="button" class="btn btn-danger btn-sm delete-image">Delete</button>
                    </div>
                @endforeach
            @else
                @if($model->ruta_grafico)
                    <div class="item">
                        <input type="hidden" name="old_charts[]" value="{{ $mode->ruta_grafico }}">
                        <a href="{{ '/images/' . $model->ruta_grafico }}" target="_blank">{{ $model->ruta_grafico }}</a>
                        <button type="button" class="btn btn-danger btn-sm delete-image">Delete</button>
                    </div>
                @endif
            @endif
        </div>
<!--
        <br>
        <div class="form-group">
            <b>@lang('PapersCreate.Conclusions')</b>
        </div>
        <div class="summary-conclusiones">  
            <div class="form-group">
                <label for="ruta_conclusiones">@lang('PapersCreate.Conclusion 1')</label>
                <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_1" required>                
            </div>            
            <div class="form-group">
                <label for="ruta_grafico">@lang('PapersCreate.Conclusion 2')</label>
                <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_2" required>
            </div>
            <div class="form-group">
                <label for="ruta_grafico">@lang('PapersCreate.Conclusion 3')</label>
                <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_3" required>
            </div>
            
        </div>
        <div class="summary-conclusiones__addnew">
            <button type="button" class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </button>
        </div>
-->
        <br><br>
        <div class="form-group">
            <label for="link_investigacion">@lang('PapersCreate.Papers url')</label>
            <input type="text" class="form-control" id="link_investigacion" name="link_investigacion" value="{{ $model->link_investigacion }}">
        </div>
        <div class="form-group">
            <label>Country</label>
            @include('auth.partials.country', ['value' => $model->country])
        </div>
        <div class="form-group">
            <label for="topic">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $model->date }}">
        </div>
        <!-- <div class="form-group">
            <label for="hashtags">@lang('PapersCreate.Tags')</label>
            <input type="text" class="form-control" id="hashtags" name="hashtags">
        </div> -->
        <br>
        <div class="form-check">
            <input class="form-check-input" style="margin-left:0;" type="checkbox" value="1" id="reviewed" name="reviewed">
            <label class="form-check-label" for="reviewed">
            @lang('PapersCreate.MyPaperHasBeenPeerReviewed')
            </label>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" style="margin-left:0;" type="checkbox" value="1" id="reviewed" name="reviewed">
            <label class="form-check-label" for="reviewed">
            @lang('PapersCreate.ImTheAuthorOfThePaper')
            </label>
        </div>
        <br>
        <button type="submit" class="btn btn-default">@lang('PapersCreate.Send')</button>
    </form>
    </br>
    Some sources to find scientific papers:</br> 
    <a href="https://scholar.google.com/" target="_blank">Google Scholar</a></br>
    <a href="https://www.academia.edu" target="_blank">Academia.edu</a></br>
    <a href="https://www.elsevier.com/solutions/mendeley" target="_blank">Elseiver</a></br>   
    <a href="https://www.researchgate.net/" target="_blank">Researchgate</a></br>
    <a href="https://www.scopus.com/home.uri" target="_blank">Scopus</a></br></br>  
    You can also try with any local repository of your country.</br>
    For Uruguay: <a href="http://www.biur.edu.uy/F" target="_blank">Biur</a>

@endsection

@section('js_scripts')
    <script>
        console.log('script is working');
        $('.item .delete-image').on('click', function() {
            var me = $(this);
            me.closest('.item').remove();
        });
    </script>
@endsection