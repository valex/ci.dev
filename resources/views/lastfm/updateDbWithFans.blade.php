@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">
                    <p>new_users : {{ $new_users }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection