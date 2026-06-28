@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $designationsCount }}</h3>
                <p>Total Designations</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $usersCount }}</h3>
                <p>Total Users</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $activeUsersCount }}</h3>
                <p>Active Users</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $inactiveUsersCount }}</h3>
                <p>Inactive Users</p>
            </div>
        </div>
    </div>

</div>
@stop