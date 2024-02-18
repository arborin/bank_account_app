@extends('layout.app')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Payment</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('accounts.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="account-name" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input name="account_name" value="{{ date('m/d/Y') }}" id="datepicker" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="account-number" class="col-sm-3 col-form-label">Account</label>
                        <div class="col-sm-9">
                            <select class="form-control selectpicker" name="part" data-live-search="true" required>
                                <option value="">-Select account</option>
                                @foreach ($accounts as $row)
                                    <option value="Part 1" data-tokens="Part 1">{{ $row->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                            <a href="{{ route('payments.index') }}" class="btn btn-secondary float-end mr-10">Back</a>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>
@endsection
