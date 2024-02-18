@extends('layout.app')

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
                                value="{{ \Carbon\Carbon::parse($payment->date)->format('m/d/Y') }}" readonly disabled
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="{{ route('payments.index') }}" class="btn btn-secondary float-end">Back</a>
                            <button type="button" class="btn btn-success float-end  mr-10">
                                <i class="bi bi-file-earmark-arrow-down"></i> Exp. Bank 1</button>
                            <button type="button" class="btn btn-success float-end  mr-10">
                                <i class="bi bi-file-earmark-arrow-down"></i> Exp. Bank 2</button>


                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add payment</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">IFSC code</th>
                            <th scope="col">Group</th>
                            <th scope="col">Bank Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-warning">
                            <th scope="row"></th>
                            <td>
                                <select class="form-control selectpicker" name="part" data-live-search="true" required>
                                    <option value="">-Select account</option>
                                    @foreach ($accounts as $row)
                                        <option value="Part 1" data-tokens="Part 1">{{ $row->account_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>ACCOUNT NUMBER</td>
                            <td>CODE</td>
                            <td>GROUP</td>
                            <td>Bank NAME</td>
                            <td><input type="text" name="amount" class="form-control" id="account-name"></td>
                            <td> <button type="submit" class="btn btn-primary"><i class="bx bxs-plus-circle"></i>
                                    Add</button>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">1</th>
                            <td>
                                ACCOUNT NAME
                            </td>
                            <td>ACCOUNT NUMBER</td>
                            <td>CODE</td>
                            <td>GROUP</td>
                            <td>Bank NAME</td>
                            <td>1000</td>
                            <td>
                                <button type="submit" class="btn btn-danger">
                                    <i class="bx bxs-minus-circle"></i> Del
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
