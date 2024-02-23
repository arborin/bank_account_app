@extends('layout.app')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit account</h5>

                <!-- General Form Elements -->
                <form method="post" action="{{ route('accounts.update', ['account' => $account->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="row mb-3">
                        <label for="account-name" class="col-sm-3 col-form-label">Account name</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_name" required value="{{ $account->account_name }}"
                                class="form-control" id="account-name">
                            @error('account_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="account-number" class="col-sm-3 col-form-label">Account number</label>
                        <div class="col-sm-9">
                            <input type="text" name="account_number" required value="{{ $account->account_number }}"
                                class="form-control" id="account-number">
                            @error('account_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="bank-name" class="col-sm-3 col-form-label">Bank name</label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_name" required value="{{ $account->bank_name }}"
                                class="form-control" id="bank-name">
                            @error('bank_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="ifsc-code" class="col-sm-3 col-form-label">IFSC code</label>
                        <div class="col-sm-9">
                            <input type="text" name="ifsc_code" required value="{{ $account->ifsc_code }}"
                                class="form-control" for="ifsc-code">
                            @error('ifsc_code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="group" class="col-sm-3 col-form-label">Group</label>
                        <div class="col-sm-9">
                            <select name="group" class="form-select" required aria-label="group" id="group">

                                @foreach ($groups as $key => $value)
                                    <option value='{{ $key }}' {{ $account->group == $key ? 'selected' : '' }}>
                                        {{ $value }}</option>
                                @endforeach

                            </select>
                            @error('group')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-select" required aria-label="Default select example"
                                id="status">
                                <option {{ $account->status == 'active' ? 'selected' : '' }} value='active'>
                                    Active
                                </option>
                                <option {{ $account->status == 'disable' ? 'selected' : '' }} value="disable">
                                    Disabled
                                </option>
                            </select>
                            @error('status')
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
