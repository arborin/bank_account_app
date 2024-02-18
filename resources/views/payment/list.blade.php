@extends('layout.app')
@section('title', 'App Payments')


@section('content')
    <div class="col-lg-12 mb-3">
        <a href="{{ route('payments.create') }}" class="btn btn-primary">Create Payment</a>
    </div>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Payment list</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Total Row</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>500</td>
                            <td>12-02-2024</td>
                            <td>5</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="bx bxs-edit"></i>Edit
                                </a>
                            </td>
                        </tr>
                        {{-- @foreach ($accounts as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->account_name }}</td>
                                <td>{{ $row->account_number }}</td>
                                <td>{{ $row->bank_name }}</td>
                                <td>{{ $row->ifsc_code }}</td>
                                <td>{{ $row->group }}</td>
                                <td>
                                    @if ($row->status == 'active')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('accounts.edit', ['account' => $row['id']]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bx bxs-edit"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

    </div>
@endsection
