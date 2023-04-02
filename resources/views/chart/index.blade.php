@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('alerts.success')
            <form method="GET" action="{{ route('charts.index')  }}" accept-charset="UTF-8">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class="form-control" value=""
                               placeholder="Search a Tag" name="search"/>
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
                <a class="btn btn-primary" style="margin-bottom: 10px" href="{{ route('create.chart')}}" }}>
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                </a>
                <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ route('charts.delete-all') }}">Delete All Selected</button>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Chart Image</th>
                        <th>Description</th>
                        <th>Tags</th>
                        <th>Source's name</th>
                        <th>Source's web</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @forelse($records as $record)
                        <tr>
                            <td><input type="checkbox" class="sub_chk" data-id="{{$record->id}}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $record->title }}</td>
                            <td>
                                <img src="{{asset('storage'.$record->template) }}" width="40" alt="">
                            </td>
                            <td>{!! str_limit($record->topic, '100') !!}</td>
                            <td>
                                @foreach(@$record->tags as $tag)
                                {{ $tag->name }}
                                @endforeach</td>
                            <td>{{ $record->author}}</td>
                            <td>{{ $record->author_email}}</td>
                            <td>
                               <div class="d-inline-flex">
                                   <a href="{{ route('charts.changeStatus',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       @if($record->status)
                                            <i class="fa fa-times"></i>
                                       @else
                                            <i class="fa fa-check"></i>
                                        @endif     
                                   </a>
                                   <a href="{{ route('charts.edit',[$record->id]) }}" class="btn btn-primary btn-sm mr-1">
                                       <i class="fa fa-edit"></i>
                                   </a>
                                    <a onclick="return confirm('Are you sure want to delete?');" href="{{ route('charts.destroy',[$record->id]) }}" class="btn btn-danger btn-sm mr-1">
                                        <i class="fa fa-trash"></i>
                                    </a>
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