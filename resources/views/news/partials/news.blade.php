<div class="tab-pane {{ request()->query('paper') ? '' : 'active' }}" id="news">
    <a href="#" id="approve_news" data-url={{ url('/news/update') }}>
        <i class="fa fa-check"></i>&nbsp;&nbsp;Approve
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="#" id="classify_news" data-url={{ url('/news/classify') }}>
        <i class="fa fa-braille"></i>&nbsp;&nbsp;Classify
    </a>

    <img class="loading-spinner" style="display:none" width="25px" height="25px"
         src="{{ asset('images/spinner.gif') }}">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Description</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="items">
            @foreach ($news as $item)
                <tr>
                    <td><input class="itm__index" type="checkbox" value={{ $item->id }}></td>
                    <td><a href="{{ $item->url }}">{{ $item->title }}</a></td>
                    <td>{!! $item->content_without_html_tags !!}</td>
                    <td>
                        {{  implode(',',$item->tags->pluck('title')->toArray()) }}
                    </td>
                    <td>
                        <a href="{{ action('NewsController@edit', $item->id) }}"><i
                                    class="fa fa-edit"></i>Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
                <ul class="pagination" id="myPager"></ul>
            </div>
        </div>
    </div>
</div>