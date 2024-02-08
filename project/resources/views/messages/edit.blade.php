@extends('layouts.main')
@section('content')
    <div class="col-5 mx-auto">
        <form>
            @csrf
            <div class="form-group center">
                <input type="hidden" name="message_id" id="message_id" value="{{ $message->id }}">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" value="{{ $message->name }}">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ $message->email }}">
                <label for="text">Сообщение</label>
                <textarea class="form-control" id="message" rows="8">{{ $message->message }}</textarea>
                <button class="btn btn-primary sendmessage">Отправить</button>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Успешно</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Сообщение отправлено</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.sendmessage').click(function() {
            event.preventDefault();

            $.ajax({
                url: "/messages/"+$('#message_id').val(),
                type:"PUT",
                data:{
                    "_token": "{{ csrf_token() }}",
                    name:$('#name').val(),
                    email:$('#email').val(),
                    message:$('#message').val()
                },
                success: function(response) {
                    $('#modal').modal('show');
                },
            });
        });
    </script>
@endsection
