<label>Select Topics</label>
<br>
@foreach($records as $record)
    <button type="button" class="btn btn-secondary">
        {{$record->name}} <span class="badge badge-info">{{ $record->children_count }}</span>
    </button>
@endforeach