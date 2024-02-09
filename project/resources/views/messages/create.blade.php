@extends('layouts.main')
@section('content')
    <div class="col-7 mx-auto">
        <form>
            @csrf
            <div class="form-group center">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email">
                <label for="text">Сообщение</label>
                <textarea class="form-control" id="message" rows="8"></textarea>

                <div class="agreement d-flex justify-content-left align-items-center">
                    <input type="checkbox" id="agreement" value="false">
                    <label for="agreement">Согласие на обработку персональных данных</label>
                </div>

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
    <div class="modal fade" id="modal-error" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ошибка</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-error-text"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.sendmessage').click(function() {
            event.preventDefault();

            $.ajax({
                url: "/messages",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    name:$('#name').val(),
                    email:$('#email').val(),
                    message:$('#message').val(),
                    agreement:$('#agreement').val(),
                },
                success: function(response) {
                    $('#modal').modal('show');
                },
                error :function( data ) {
                    if (data.status === 422) {
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#modal-error-text').append(value+"<br/>");
                        });

                        $('#modal-error').modal('show');
                    }
                }
            });
        });

        $('#agreement').click(function() {
            if ($(this).val() == 'false') {
                $(this).val('true');
            } else {
                $(this).val('false');
            }
        })
    </script>
@endsection
