@extends('adminlte::page')

@section('title', 'Create User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create User</h3>
    </div>
    <div class="card-body">
        <form id="userForm">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control">
                        <span class="text-danger" id="name_error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control">
                        <span class="text-danger" id="email_error"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control">
                        <span class="text-danger" id="password_error"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" id="contact_number" class="form-control">
                        <span class="text-danger" id="contact_number_error"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Alternative Contact Number</label>
                <input type="text" id="alternative_contact_number" class="form-control">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea id="address" class="form-control" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Designation</label>
                        <select id="designation_id" class="form-control">
                            @foreach($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="saveUser">Save User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$('#saveUser').click(function(){
    $('#name_error').text('');
    $('#email_error').text('');
    $('#password_error').text('');
    $('#contact_number_error').text('');

    $.ajax({
        url: '{{ route('users.store') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            contact_number: $('#contact_number').val(),
            alternative_contact_number: $('#alternative_contact_number').val(),
            address: $('#address').val(),
            designation_id: $('#designation_id').val(),
            status: $('#status').val()
        },
        success: function(response){
            alert(response.message);
            window.location = '{{ route('users.index') }}';
        },
        error: function(xhr){
            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                if(errors.name) $('#name_error').text(errors.name[0]);
                if(errors.email) $('#email_error').text(errors.email[0]);
                if(errors.password) $('#password_error').text(errors.password[0]);
                if(errors.contact_number) $('#contact_number_error').text(errors.contact_number[0]);
            }
        }
    });
});
</script>
@stop
