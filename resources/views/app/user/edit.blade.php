@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit User</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.manage') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <p class="card-description">Form edit user</p>
                    <form action="{{ route('users.update', ['user' => $user->username]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control" name="role_id" id="role_id" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach (\App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            @if ($user->avatar)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid mx-auto d-block" style="height: 100px;" />
                                </div>
                            @endif
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control file-upload-info" name="avatar" id="avatar">
                            </div>
                            @error('avatar')
                                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
