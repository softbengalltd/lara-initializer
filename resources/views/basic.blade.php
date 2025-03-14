@extends('larainitializer::layouts.app')

@section('content')
    <form method="POST" action="{{ route('squartup.setup.submit') }}">
        @csrf
        <input type="hidden" name="step" value="basic">
        <div class="card-body">
            <x-input 
                label="App Name" 
                name="app_name" 
                type="text" 
                placeholder="Enter app name"
                value="{{ old('app_name') ?? getenv('APP_NAME') }}"
                error="{{ $errors->first('app_name') }}"
            />
            <div class="form-group">
                <label>
                    Chose App Locale
                    @if ($errors->has('app_locale'))
                        <span class="text-danger">required*</span>
                    @endif
                </label>
                <select multiple name="app_locale" class="form-control" style="height:300px">
                    <?php foreach ($locales as $localeCode => $localeName): ?>
                    <option value="<?= $localeCode ?>" @if ($localeCode == getenv('APP_LOCALE'))
                        selected
                        @endif><?= $localeName ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn"
                style="background-color: #7b48cd; color: white; width: 100px; float: right;">Next</button>
        </div>
    </form>
@endsection
