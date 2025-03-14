@extends('larainitializer::layouts.app')

@section('title', 'Email Setup')

@section('content')
    <form method="POST" action="{{ route('squartup.setup.submit') }}">
        @csrf
        <input type="hidden" name="step" value="email">
        <div class="card-body">
            <div class="form-group">
                <label>Email Username @if ($errors->has('mail_username'))
                        <span class="text-danger">required*</span>
                    @endif
                </label>
                <input type="email" class="form-control" name="mail_username"
                    value="{{ old('mail_username') ?? (getenv('MAIL_USERNAME') ?? '') }}" placeholder="Enter email username">
            </div>
            <div class="form-group">
                <label>Email Password @if ($errors->has('mail_password'))
                        <span class="text-danger">required*</span>
                    @endif
                </label>
                <input type="password" class="form-control" name="mail_password"
                    value="{{ old('mail_password') ?? (getenv('MAIL_PASSWORD') ?? '') }}" placeholder="Enter email password">
            </div>
            <div class="form-group">
                <label>Organization Email @if ($errors->has('mail_from_address'))
                        <span class="text-danger">required*</span>
                    @endif
                </label>
                <input type="email" class="form-control" name="mail_from_address"
                    value="{{ old('mail_from_address') ?? (getenv('MAIL_FROM_ADDRESS') ?? '') }}"
                    placeholder="Organization email">
            </div>
            <div class="form-group">
                <label>Organization Name in email @if ($errors->has('mail_from_name'))
                        <span class="text-danger">required*</span>
                    @endif
                </label>
                <input type="text" class="form-control" value="{{ getenv('MAIL_FROM_NAME') ?? '' }}"
                    placeholder="Organization email" disabled>
            </div>

            <a href="{{ route('squartup.setup.form', ['basic']) }}" class="btn"
                style="background-color: #7b48cd; color: white; width: 200px; float: left;">Basic Setup</a>

            <button type="submit" class="btn"
                style="background-color: #7b48cd; color: white; width: 200px; float: right;">Next</button>
        </div>
    </form>
@endsection
