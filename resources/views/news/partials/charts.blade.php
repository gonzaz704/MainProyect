<div class="tab-pane" id="charts">
    <a href="/charts/create" }}>
        <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
    </a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="items">
            @foreach ($charts as $item)
                <tr>
                    <td><input class="itm__index" type="checkbox" value={{ $item->id }}></td>
                    <td><a href="{{ $item->url }}">{{ $item->title }}</a></td>
                    <td>{!! $item->description !!}</td>
                    <td>
                        <a href="{{ action('ChartController@edit', $item->id) }}">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ action('ChartController@destroy',$item->id) }}">
                            <i class="fa fa-trash"> Delete</i>
                        </a>
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