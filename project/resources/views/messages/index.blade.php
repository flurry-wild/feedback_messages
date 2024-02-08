@extends('layouts.main')
@section('content')
    @foreach ($messages as $message)
    <div class="col-12 mx-left">
        <div class="card m-4"  style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title"><b>{{ sprintf('%d.%s', $message->id, $message->name) }}</b></h5>
                <h7>{{ $message->created_at }}</h7>
                <p class="card-text">{{ $message->message }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($page > 1)
            <li class="page-item"><a class="page-link" href="{{ route('messages.index', ['page' => $page - 1]) }}">Предыдущая</a></li>
            @endif
            @if ($page < $countPages)
            <li class="page-item"><a class="page-link" href="{{ route('messages.index', ['page' => $page + 1]) }}">Следующая</a></li>
            @endif
            <li class="page-item"><a class="page-link" href="{{ route('messages.index', ['page' => $countPages]) }}">Последняя</a></li>
        </ul>
    </nav>
@endsection
