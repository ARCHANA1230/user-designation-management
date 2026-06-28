@extends('adminlte::page')

@section('title', 'Create Designation')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Designation</h3>
    </div>
    <div class="card-body">
        <form id="designationForm">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="title" class="form-control">
                <span class="text-danger" id="title_error"></span>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select id="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="saveDesignation">Save</button>
            <a href="{{ route('designations.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$('#saveDesignation').click(function(){
    $('#title_error').text('');

    $.ajax({
        url: '{{ route('designations.store') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            title: $('#title').val(),
            status: $('#status').val()
        },
        success: function(response){
            alert(response.message);
            window.location = '{{ route('designations.index') }}';
        },
        error: function(xhr){
            if(xhr.status === 422){
                $('#title_error').text(xhr.responseJSON.errors.title[0]);
            }
        }
    });
});
</script>
@stop
