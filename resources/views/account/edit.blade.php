@extends('layout.app')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add account</h5>

                <!-- General Form Elements -->
                <form method="post" action="{{ route('accounts.update', ['account' => $account->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="row mb-3">
                        <label for="account-name" class="col-sm-3 col-form-label">Account name</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_name" value="{{ $account->account_name }}"
                                class="form-control" id="account-name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="account-number" class="col-sm-3 col-form-label">Account number</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_number" value="{{ $account->account_number }}"
                                class="form-control" id="account-number">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="bank-name" class="col-sm-3 col-form-label">Bank name</label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_name" value="{{ $account->bank_name }}" class="form-control"
                                id="bank-name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ifsc-code" class="col-sm-3 col-form-label">IFSC code</label>
                        <div class="col-sm-9">
                            <input type="text" name="ifsc_code" value="{{ $account->ifsc_code }}" class="form-control"
                                for="ifsc-code">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="group" class="col-sm-3 col-form-label">Group</label>
                        <div class="col-sm-9">
                            <select name="group" class="form-select" aria-label="Default select example" id="group">
                                <option {{ $account->group == 'contractors' ? 'selected' : '' }} value='contractors'>
                                    Contractors
                                </option>
                                <option {{ $account->group == 'labour' ? 'selected' : '' }} value='labour'>
                                    Labour
                                </option>
                                <option {{ $account->group == 'staff' ? 'selected' : '' }} value='staff'>
                                    Staff
                                </option>
                                <option {{ $account->group == 'one_time' ? 'selected' : '' }} value='one_time'>
                                    One time
                                </option>
                                <option {{ $account->group == 'vendor' ? 'selected' : '' }} value='vendor'>
                                    Vendor
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-select" aria-label="Default select example" id="status">
                                <option {{ $account->status == 'active' ? 'selected' : '' }} value='active'>
                                    Active
                                </option>
                                <option {{ $account->status == 'disable' ? 'selected' : '' }} value="disable">
                                    Disabled
                                </option>
                            </select>
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