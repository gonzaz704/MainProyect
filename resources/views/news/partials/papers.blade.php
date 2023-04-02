<div class="tab-pane {{ request()->query('paper') ? 'active' : '' }}" id="papers">
    <div class="row">
        <div class="col-sm-12">
            <form method="GET" action="{{ url('/news')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ request()->query('paper') }}"
                               placeholder="Search a Paper" name="paper"/>
                        <span class="input-group-btn">
                        <button class="btn btn-info btn-md" type="submit">
                            <i class="ficon ft-search"></i>
                        </button>
                    </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12 mt-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @foreach ($papers as $paper)
                        <tr>
                            <td>{{ $paper->titulo }}</td>
                            <td>{{ $paper->createdBy->name }}</td>
                            <td>{{ format_date($paper->date) }}</td>
                            <td>
                                <a href="{{ route('paper.view',['id' => $paper->id]) }}">
                                    <i class="fa fa-eye"></i>View 
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>