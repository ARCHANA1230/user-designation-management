@extends('adminlte::page')

@section('title', 'Designations')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">Designation Management</h3>

        <a href="{{ route('designations.create') }}" class="btn btn-primary float-right">
            Add Designation
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($designations as $designation)

                <tr>

                    <td>{{ $designation->id }}</td>

                    <td>{{ $designation->title }}</td>

                    <td>
                        {{ $designation->status ? 'Active' : 'Inactive' }}
                    </td>

                    <td>

                        <button
                            class="btn btn-warning btn-sm editBtn"
                            data-id="{{ $designation->id }}">
                            Edit
                        </button>

                        <button
                            class="btn btn-danger btn-sm deleteBtn" data-id="{{ $designation->id }}">
                            
                            Delete
                        </button>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$('.editBtn').click(function(){
    let id = $(this).data('id');
    window.location = '/designations/' + id + '/edit';
});

$('.deleteBtn').click(function(){
    if(confirm('Delete this designation?')){
        let id = $(this).data('id');
        $.ajax({
            url:'/designations/'+id,
            type:'DELETE',
            data:{
                _token:"{{ csrf_token() }}"
            },
            success:function(response){
                alert(response.message);
                location.reload();
            }
        });
    }
});
</script>
@stop