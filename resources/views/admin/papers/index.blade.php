@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
            <form method="GET" action="{{ route('admin.papers.index')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$search}}"
                               placeholder="Search a Paper" name="search"/>
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
                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('admin.papers.delete-all') }}">Delete All Selected</button>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>S.N</th>
                        <th>User name</th>
                        <th>Author (Name)</th>
                        <th>Author Email</th>
                        <th>Title</th>
                        <th>Tutors</th>
                        <th>Key Words</th>
                        <th>Abstract</th>
                        <th>Charts</th>
                        <th>Repository Location</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td><input type="checkbox" class="sub_chk" data-id="{{$record->id}}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->createdBy->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($record->author_name, 50, $end='...') }}</td> 
                            <td>{{ \Illuminate\Support\Str::limit($record->author, 50, $end='...') }}</td>
                            <td>{{\Illuminate\Support\Str::limit($record->titulo, 50, $end='...')}}</td>
                            <td>{{\Illuminate\Support\Str::limit($record->tutors, 50, $end='...')}}</td>
                            <td>{{implode(', ', App\Tag::whereIn('id', $record->tags)->pluck('name')->toArray())}}</td>
                            <td>{!! \Illuminate\Support\Str::limit($record->abstract, 50, $end='...') !!}</td>
                            <td>
                                @foreach($record->ruta_grafico as $image)
                                    <a href="{{asset('images/'.$image)}}" target="_blank">{{$image}}</a><br>
                                @endforeach
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($record->link_investigacion, 50, $end='...')}}</td>
                            <td>
                               <div class="d-inline-flex">
                                @if ($record->status==1)
                                    <a href="{{ route('admin.papers.reject',$record->id) }}" class="btn btn-primary btn-sm mr-1">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @else
                                    <a href="{{ route('admin.papers.approve',$record->id) }}" class="btn btn-primary btn-sm mr-1">
                                        <i class="fa fa-check"></i>
                                    </a>
                                @endif
                                    <a href="{{ route('admin.papers.review',$record->id) }}" class="btn btn-primary btn-sm mr-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Are you sure want to delete?');" action="{{ route('admin.papers.destroy',[$record->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <button class="btn btn-sm btn-danger" href="" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                               </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No tags Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $records->links() }}
        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        console.log('ready');
        // checked all row
        $('#master').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true);  
            } else {  
                $(".sub_chk").prop('checked',false);  
            }  
        });

        //delete all selected records
        $('.delete_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  
                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  
                    var join_selected_values = allVals.join(","); 
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['message']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            console.log('err');
                            alert(data.responseText);
                        }
                    });
                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });

    });
</script>
@endpush