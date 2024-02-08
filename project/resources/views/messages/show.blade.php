@extends('layouts.main')
@section('content')
    <div class="col-12 mx-left">
        <div class="card m-4"  style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title"><b>Имя</b></h5>
                <p class="card-text">{{ $message->name }}</p>
            </div>
        </div>
        <div class="card m-4" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title"><b>E-mail</b></h5>
                <p class="card-text">{{ $message->email }}</p>
            </div>
        </div>
        <div class="card m-4" style="width: 70%;">
            <div class="card-body">
                <h5 class="card-title"><b>Сообщение</b></h5>
                <p class="card-text">{{ $message->message }}</p>
            </div>
        </div>
    </div>
@endsection
