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
                            <th>Total Rows</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>0</td>
                                <td>{{ \Carbon\Carbon::parse($row->date)->format('m/d/Y') }}</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ route('payments.edit', ['payment' => $row['id']]) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bx bxs-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>

    </div>
@endsection
