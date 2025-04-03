@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Game</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('games.store') }}" method="POST">
                        @include('games.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 