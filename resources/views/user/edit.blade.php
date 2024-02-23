@extends('layout.app')

@section('title', 'App users')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit user</h5>

                <!-- General Form Elements -->
                <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="row mb-3">
                        <label for="account-name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" required value="{{ $user->name }}" class="form-control"
                                id="account-name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Account number</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" required value="{{ $user->email }}" class="form-control"
                                id="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" value="" autocomplete="new-password"
                                class="form-control" id="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                            <a href="{{ route('accounts.index') }}" class="btn btn-secondary float-end mr-10">Back</a>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
@endsection
