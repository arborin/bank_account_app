@extends('layout.app')

@section('title', 'App payments')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manage Payment</h5>

                <!-- General Form Elements -->
                <form method="" action="">
                    <div class="row mb-3">
                        <label for="account-name" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="account_name"
                                value="{{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}" readonly disabled
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="{{ route('payments.index') }}" class="btn btn-secondary float-end">Back</a>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Payments - <span class="text-danger">Total amount:
                        {{ $payment->transactions->sum('amount') }}</span></h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" width="15%">Account Name</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">IFSC code</th>
                            <th scope="col">Group</th>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" id="add-form" action="{{ route('add-transaction') }}">
                            @csrf
                            <tr class="table-warning">
                                <th scope="row"></th>
                                <td>
                                    <input name='payment_id' type="hidden" value="{{ $payment->id }}" id="payment_id" />
                                    <input name='account_id' type="hidden" id="account_id" />
                                    <select required class="form-control selectpicker" name="account" id="account"
                                        data-live-search="true">
                                        <option value="" selected disabled>- select -</option>
                                        @foreach ($accounts as $row)
                                            <option value="{{ $row->id }}">{{ $row->account_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><span id="account_number"></span></td>
                                <td><span id="ifsc_code"></span></td>
                                <td><span id="group"></span></td>
                                <td><span id="bank_name"></span></td>
                                <td>
                                    <input type="text" name="amount" class="form-control" id="amount" required />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary add-record">
                                        <i class="bx bxs-plus-circle"></i> Add
                                    </button>
                                </td>
                            </tr>
                        </form>


                        @foreach ($payment->transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ optional($transaction->account)->account_name }}</td>
                                <td>{{ optional($transaction->account)->account_number }}</td>
                                <td>{{ optional($transaction->account)->ifsc_code }}</td>
                                <td>{{ optional($transaction->account)->group }}</td>
                                <td>{{ optional($transaction->account)->bank_name }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>
                                    <button id="del-transaction_{{ $transaction->id }}" type="button"
                                        class="btn btn-danger delete-btn btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
                                        <i class="bx bxs-minus-circle"></i> Delete
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('modal.modal')
@endsection



@section('scripts')
    <script>
        $(document).ready(function() {

            function updateData(data) {
                console.log(data);
                $("#account_number").text(data.account_number)
                $("#ifsc_code").text(data.ifsc_code)
                $("#group").text(data.group)
                $("#bank_name").text(data.bank_name)
                $("#account_id").val(data.id)
                // $("#amount").val('')
            }

            $("#account").change(function() {
                const account_id = $(this).find(":selected").val();

                const url = "/account/info/" + account_id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Handle successful response
                        // alertify.success('Success');
                        updateData(data);
                        // console.log('Data received:', data);
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        alertify.error("Error");
                        console.error('AJAX request failed. Status:', status, 'Error:', error);
                    }
                });
            });


            $(".add-record").click(function() {
                const account_id = $('#account_id').val()
                const amount = $('#amount').val()

                if (account_id == '') {
                    // alertify.error('Account not selected');
                    $('.border-gray').toggleClass("border-red");
                } else {
                    $('.border-red').toggleClass("border-red");
                }
                if (amount == '') {
                    $('#amount').removeClass("border-gray");
                    $('#amount').addClass("border-red");
                    // alertify.error('Amount is empty');
                    return
                } else {
                    $('#amount').addClass("border-gray");
                    $('#amount').removeClass("border-red");
                }

                if (account_id != '' && amount != '') {
                    $("#add-form").submit();
                }
            })
        })
    </script>
@endsection
