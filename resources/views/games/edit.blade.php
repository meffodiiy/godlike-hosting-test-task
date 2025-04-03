@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Game</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('games.update', $game) }}" method="POST">
                        @method('PUT')
                        @include('games.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 