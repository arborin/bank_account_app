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
                            <th>Payment status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->transactions->sum('amount') }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
                                <td>{{ count($row->transactions) }}</td>
                                <td>
                                    <select class="form-select form-control-sm payment-status" aria-label="payment status"
                                        id="{{ $row->id }}">
                                        <option value="not_paid" {{ $row->status == 'not_paid' ? 'selected' : '' }}>Not paid
                                        </option>
                                        <option value="paid_ib" {{ $row->status == 'paid_ib' ? 'selected' : '' }}>
                                            PAY-IDFC-MAIN
                                        <option value="paid_kb" {{ $row->status == 'paid_kb' ? 'selected' : '' }}>
                                            PAY-KMB-RERA
                                        </option>
                                        <option value="paid_kb_main" {{ $row->status == 'paid_kb_main' ? 'selected' : '' }}>
                                            PAY-KMB-MAIN
                                        </option>

                                    </select>

                                </td>
                                <td width="10%">
                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                        <button id="del-payment_{{ $row->id }}" type="button"
                                            class="btn btn-danger delete-btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="bx bxs-minus-circle"></i> Delete
                                        </button>
                                        <a href="{{ route('payments.edit', ['payment' => $row['id']]) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <button id="print-payment_{{ $row['id'] }}"
                                            class="btn btn-secondary btn-sm btn-print"><i class="bx bxs-printer"></i>
                                        </button>

                                        <a href="{{ route('payment-export', ['payment_id' => $row['id']]) }}"
                                            class="btn btn-success btn-sm"><i class="bx bxs-download"></i>
                                        </a>



                                        {{-- <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Export
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="#">IDFC Bank-788</a>
                                                <a class="dropdown-item" href="#">Kotak bank-005</a>
                                            </div>
                                        </div> --}}
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

    <div id="printView">
        <!-- Content will be loaded here -->
    </div>

    @include('modal.modal')
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            $(".btn-print").on("click", function() {
                $
                // URL of the page to load (replace "YOUR_PAGE_URL" with the actual URL)
                const payment_id = $(this).attr('id').split("_")[1];
                const pageUrl = `/payment/transaction-print/${payment_id}`;

                // Create an iframe to isolate the content
                let iframe = $('<iframe>', {
                    id: 'printIframe',
                    frameborder: 0,
                    css: {
                        position: 'absolute',
                        width: '0',
                        height: '0',
                        border: 'none'
                    }
                });

                // Append the iframe to the print view
                $("#printView").append(iframe);

                // Set the source of the iframe to the target link
                iframe.attr('src', pageUrl);

                // Show and print the print view when the iframe is loaded
                iframe.on('load', function() {
                    // Show and print the print view
                    $("#printView").show();
                    window.frames['printIframe'].focus();
                    window.frames['printIframe'].print();

                    // Remove the iframe after printing
                    $("#printView").empty().hide();
                });
            });



            $(".payment-status").change(function() {
                const status = $(this).find(":selected").val();
                const payment_id = $(this).attr('id');

                const url = "/set-payment-status";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        status: status,
                        payment_id: payment_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Handle successful response
                        alertify.success(data.message);
                        // updateData(data);
                        console.log('Data received:', data);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        // alertify.error("Error");
                        console.error('AJAX request failed. Status:', status, 'Error:', error);
                    }
                });
            });
        })
    </script>

@endsection
