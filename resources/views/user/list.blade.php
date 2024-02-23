@extends('layout.app')


@section('content')
    <div class="col-lg-12 mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    </div>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Accounts list</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <a href="{{ route('accounts.edit', ['account' => $row['id']]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bx bxs-edit"></i> Edit
                                        </a>
                                        <button id="del-user_{{ $row->id }}" type="button"
                                            class="btn btn-danger delete-btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="bx bxs-minus-circle"></i> Delete
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

    </div>
    @include('modal.modal')
@endsection
