<div class="container mt-1">
    <h3 style="text-align:center">@lang('dashboard.SelectCharts')</h3>
    <h5 style="text-align:center">@lang('dashboard.text')<h5> </br>
   
    <form method="POST" action="{{route('news.charts', $news->id)}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @php $selected = $news->charts->pluck('id')->toArray() ?? []; @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group"></br></br>
                    <label for="tags">@lang('dashboard.charts')</label>
                    <select name="charts[]" class="tag-selector" id="charts" multiple="multiple" required>
                        @foreach($charts as $key => $chart)
                            <option value="{{$key}}"
                            {{ in_array($key,$selected) ? 'selected' : '' }}
                            >{{ $chart }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-default">@lang('dashboard.upload-chart')</button>
    </form>
</div>