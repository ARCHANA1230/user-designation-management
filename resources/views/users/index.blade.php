@extends('adminlte::page')

@section('title', 'Users')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">User Management</h3>

        <a href="{{ route('users.create') }}" class="btn btn-primary float-right">
            Add User
        </a>

    </div>

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-4">
                <select class="form-control" id="designation_filter">
                    <option value="">All Designations</option>

                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}">
                            {{ $designation->title }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4">

                <select class="form-control" id="status_filter">
                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

            </div>

        </div>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th width="170">Action</th>

                </tr>

            </thead>

            <tbody id="userTable">
                <tr id="emptyStateRow">
                    <td colspan="6" class="text-center text-muted">Loading users...</td>
                </tr>
            </tbody>

        </table>

    </div>

</div>

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function(){
    loadUsers();
});

function loadUsers(){
    $('#userTable').html(`<tr><td colspan="6" class="text-center text-muted">Loading users...</td></tr>`);

    $.get('{{ route('users.list') }}',{
        designation: $('#designation_filter').val(),
        status: $('#status_filter').val()
    },function(users){
        let row='';

        if (!users.length) {
            row = `<tr><td colspan="6" class="text-center text-muted">No users found.</td></tr>`;
            $('#userTable').html(row);
            return;
        }

        $.each(users,function(i,user){
            row+=`
            <tr>
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.designation ? user.designation.title : ''}</td>
                <td>${user.status==1?'Active':'Inactive'}</td>
                <td>
                    <button class="btn btn-warning btn-sm editBtn" data-id="${user.id}">Edit</button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-id="${user.id}">Delete</button>
                </td>
            </tr>
            `;
        });

        $('#userTable').html(row);
    }).fail(function(){
        $('#userTable').html(`<tr><td colspan="6" class="text-center text-danger">Unable to load users.</td></tr>`);
    });
}

$('#designation_filter,#status_filter').change(function(){
    loadUsers();
});

$(document).on('click','.editBtn',function(){
    let id=$(this).data('id');
    window.location = '/users/' + id + '/edit';
});

$(document).on('click','.deleteBtn',function(){
    if(confirm('Delete User?')){
        let id=$(this).data('id');
        $.ajax({
            url:'/users/'+id,
            type:'DELETE',
            data:{
                _token:"{{ csrf_token() }}"
            },
            success:function(res){
                alert(res.message);
                loadUsers();
            }
        });
    }
});
</script>
@stop