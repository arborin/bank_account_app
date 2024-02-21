@extends('print.layout')

@section('script')
    <script>
        window.print();
    </script>
@endsection
@section('content')
    <div class="col-md-12">
        <h6>Payment date: {{ \Carbon\Carbon::parse($payment->date)->format('d/m/Y') }}</h6>
        <h6>Total amount: {{ $payment->transactions->sum('amount') }}</h6>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                    <th>IFSC code</th>
                    <th>Group</th>
                    <th>Bank Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment->transactions as $transaction)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ optional($transaction->account)->account_name }}</td>
                        <td>{{ optional($transaction->account)->account_number }}</td>
                        <td>{{ optional($transaction->account)->ifsc_code }}</td>
                        <td>{{ optional($transaction->account)->group }}</td>
                        <td>{{ optional($transaction->account)->bank_name }}</td>
                        <td>{{ $transaction->amount }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
