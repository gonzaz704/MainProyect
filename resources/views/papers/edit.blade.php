@extends('layouts.papers')
@inject('tag_helper','App\Helpers\TagHelper')
{{-- @php $selected_tags = $model->tags->pluck('id')->toArray() @endphp --}}
@section('content') 
    <form method="POST" action="{{ route('papers.update',['paper' => $model->id]) }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="topic">Topic</label>
            <input type="text" class="form-control" id="topic" name="topic" value="{{ $model->topic }}">
        </div>
        <div class="form-group">
            <label for="titulo">Titulo</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $model->titulo }}">
        </div>
         <div class="form-group">
            <label for="tags">@lang('PapersCreate.Tags')</label>
            <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                @foreach($tag_helper->dropdown() as $tag)
                    <option {{ in_array($tag->id,$model->tags) ? 'selected' : null}} value="{{ $tag->id}}">{{ $tag->name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="editor">Abstract</label>
            <textarea type="text" class="form-control" id="editor" name="abstract">{{ $model->abstract }}</textarea>
        </div>
        <br>

        <div class="form-group">
            <div class="row">
                @if(is_array($model->ruta_grafico))
                    @foreach($model->ruta_grafico as $image)
                       <div class="col-sm-2">
                           <img class="card-img-top img-responsive" src="{{ '/images/' . $image }}"
                                alt="Card image cap" style="max-width: 100%;">
                       </div>
                    @endforeach
                @else
                    @if($model->ruta_grafico)
                        <img class="card-img-top img-responsive" src="{{ '/images/' .$model->ruta_grafico }}"
                             alt="Card image cap">
                    @endif
                @endif
            </div>
            <br>
            <label for="ruta_grafico">Gráfico</label>
            <input type="file" class="form-control" id="ruta_grafico" name="charts[]" multiple>
        </div>
        <br>
        <div class="form-group">
            <label for="ruta_conclusiones">Conclusion 1</label>
            <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_1" value="{{ $model->conclusiones_1 }}">
        </div>
        <div class="form-group">
            <label for="ruta_conclusiones">Conclusion 2</label>
            <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_2" value="{{ $model->conclusiones_2 }}">
        </div>

        <div class="form-group">
            <label for="ruta_conclusiones">Conclusion 3</label>
            <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_3" value="{{ $model->conclusiones_3 }}">
        </div>
        <br><br>
        <div class="form-group">
            <label for="link_investigacion">Link de la investigación</label>
            <input type="text" class="form-control" id="link_investigacion" name="link_investigacion" value="{{ $model->link_investigacion }}">
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
    </form>
@endsection
