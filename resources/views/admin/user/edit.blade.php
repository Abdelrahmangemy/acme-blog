@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="card mt-4">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{ url('admin/update-user/'.$user->id) }}" method="POST">
            {{ csrf_field() }}
            @method('PUT')
                <div class="mb-3">
                    <label>User Role</label>
                    <select name="role_as" class="form-control">
                        <option value="1" {{ $user->role_as == '1' ? 'selected':'' }}>Admin</option>
                        <option value="0" {{ $user->role_as == '0' ? 'selected':'' }}>User</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update User</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection