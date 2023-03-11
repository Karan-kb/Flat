@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $flat->name }} - Add Rating</div>
        <div class="card-body">
            <form method="POST" action="{{ route('ratings.store', $flat) }}">
                @csrf

                <div class="form-group row">
                    <label for="score" class="col-md-4 col-form-label text-md-right">{{ __('Score') }}</label>

                    <div class="col-md-6">
                        <input id="score" type="number" class="form-control @error('score') is-invalid @enderror" name="score" value="{{ old('score') }}" required autofocus min="1" max="5">

                        @error('score')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                    <div class="col-md-6">
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="3">{{ old('comment') }}</textarea>

                        @error('comment')
                            <span class="invalid-feedback"
