@extends('layout.app')

@section('title', 'App payments')

@section('content')
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Payment</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('payments.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="datepicker" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">

                            <div class="input-group">
                                <input class="form-control" name="date" value="{{ date('d/m/Y') }}" id="datepicker"
                                    autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="bx bxs-calendar"></i></span>
                                </div>

                            </div>
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
