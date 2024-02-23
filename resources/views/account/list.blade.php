@extends('layout.app')

@section('title', 'App accounts')

@section('content')
    <div class="col-lg-12 mb-3">
        <a href="{{ route('accounts.create') }}" class="btn btn-primary">Add Account</a>
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
                            <th>Account name</th>
                            <th>Account number</th>
                            <th>Bank name</th>
                            <th>IFSC code</th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->account_name }}</td>
                                <td>{{ $row->account_number }}</td>
                                <td>{{ $row->bank_name }}</td>
                                <td>{{ $row->ifsc_code }}</td>
                                <td>
                                    @if (isset($groups[$row->group]))
                                        {{ $groups[$row->group] }}
                                    @endif
                                </td>
                                <td>
                                    @if ($row->status == 'active')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <a href="{{ route('accounts.edit', ['account' => $row['id']]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bx bxs-edit"></i> Edit
                                        </a>
                                        <button id="del-account_{{ $row->id }}" type="button"
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
