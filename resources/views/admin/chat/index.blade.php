@extends('adminlte::page')

@section('title', 'Chat')

@push('css')
    <style>
        a:hover {
            text-decoration: none !important;
        }

        .card {
            background: #fff;
            border: none !important;
            box-shadow: none;
        }

        .bg-active {
            background-color: #D0E8FF !important;
        }


        .send-msg {
            background: #0466C8;
            color: #ffffff;
            padding: 0.5rem 0.8rem;
            border-radius: 12px;
            font-size: 14px;
        }

        .receive-msg {
            background: #F1F1F1;
            color: #000000;
            padding: 0.5rem 0.8rem;
            border-radius: 12px;
            font-size: 14px;
        }
    </style>

    /*
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">*/
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div style="display: flex; flex-direction: column; height: 85vh;">
                    {{--  Chat Person Name Header--}}
                    <div class="d-flex gap-2 border-bottom py-2">
                        <img class="" style="object-fit: cover;border-radius: 8px;"
                             src="https://scontent.fktm17-1.fna.fbcdn.net/v/t39.30808-1/296435020_112064541585234_720637789586641176_n.jpg?stp=dst-jpg_p120x120&_nc_cat=108&ccb=1-7&_nc_sid=5f2048&_nc_ohc=ebAvvfgBVVgAb6PmoI_&_nc_ht=scontent.fktm17-1.fna&oh=00_AfCvktKLKAj3nUjEA2TPHhG2Zmz2K1RXZkdZwzABd2LWAA&oe=6623541C"
                             alt="" width="30" height="30">
                        <div class="d-flex flex-column pl-2">
                            <h6 class="m-0"
                                style="font-size: 14px;font-weight: 600;color: #000000">Florencio Dorrance</h6>
                        </div>
                    </div>
                    <div id="messages-container" style="flex-grow: 1; overflow-y: auto; padding: 20px;">
                        @foreach($messages ?? [] as $message)
                            <div>
                                @if($message->from_user_id === auth()->user()->id)
                                    <div class="d-flex justify-content-end py-1">
                                        <span class=" send-msg text-right">{{$message->body}}</span>
                                    </div>
                                @else
                                    <div class="d-flex  py-1">
                                        <span class=" receive-msg">{{$message->body}}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if($active_user)
                        <form action="{{route('chat.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="to_user_id" value="{{$active_user->id}}">
                            <div class="position-relative">
                                <input type="text" required name="body" class="form-control"
                                       placeholder="Type your message...">

                                <button type="submit" class="p-0 m-0 bg-transparent border-0"
                                        style="position: absolute;right: 0.5rem;top: 0.3rem;">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.1401 0.960043L5.11012 3.96004C-0.959883 5.99004 -0.959883 9.30004 5.11012 11.32L7.79012 12.21L8.68012 14.89C10.7001 20.96 14.0201 20.96 16.0401 14.89L19.0501 5.87004C20.3901 1.82004 18.1901 -0.389957 14.1401 0.960043ZM14.4601 6.34004L10.6601 10.16C10.5101 10.31 10.3201 10.38 10.1301 10.38C9.94012 10.38 9.75012 10.31 9.60012 10.16C9.46064 10.0189 9.38242 9.82847 9.38242 9.63004C9.38242 9.43161 9.46064 9.24118 9.60012 9.10004L13.4001 5.28004C13.6901 4.99004 14.1701 4.99004 14.4601 5.28004C14.7501 5.57004 14.7501 6.05004 14.4601 6.34004Z"
                                            fill="#0466C8"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-md-4 border-left border-right p-0">

                <h5 class="border-bottom text-center p-2" style="font-weight: 600">👋 Let’s have a delightful
                    chat. </h5>
                <div class="px-3">
                    <h6 class="py-3" style="font-weight: 600;font-size: 14px">Team members
                        <span class=""
                              style="border-radius: 50%;padding:0.3rem 0.6rem;background: #EDF2F7;font-size: 12px">{{count($users)}}</span>
                    </h6>
                    @foreach($users as $user)
                        <div class="px-1 ">
                            <a href="{{route('chat.index', ['user_id'=> $user->id])}}">
                                <div
                                    class="card p-2 d-flex flex-row {{$active_user?->id === $user->id?"bg-active":""}}">
                                    <img class="" style="object-fit: cover;border-radius: 8px;"
                                         src="https://scontent.fktm17-1.fna.fbcdn.net/v/t39.30808-1/296435020_112064541585234_720637789586641176_n.jpg?stp=dst-jpg_p120x120&_nc_cat=108&ccb=1-7&_nc_sid=5f2048&_nc_ohc=ebAvvfgBVVgAb6PmoI_&_nc_ht=scontent.fktm17-1.fna&oh=00_AfCvktKLKAj3nUjEA2TPHhG2Zmz2K1RXZkdZwzABd2LWAA&oe=6623541C"
                                         alt="" width="50" height="50">
                                    <div class="d-flex flex-column pl-2">
                                        <h6 class="m-0"
                                            style="font-size: 16px;font-weight: 600;color: #000000">{{$user->name}}</h6>
                                        <span
                                            style="font-weight: 600;font-size: 10px;color: #808288">{{$user->role}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        window.onload = function () {
            scrollToBottom()
        }

        function scrollToBottom() {
            var messagesContainer = document.getElementById('messages-container');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function fetchMessages() {
            $.ajax({
                url: `/messages?user_id={{ $active_user->id ?? '' }}`,
                type: 'GET',
                success: function (messages) {
                    const messagesContainer = $('#messages-container');
                    messagesContainer.html('')
                    let shouldScroll = messagesContainer.scrollTop() + messagesContainer.innerHeight() >= messagesContainer[0].scrollHeight;
                    $.each(messages, function (index, message) {
                        if (message.from_user_id === {{ auth()->id() }}) {
                            messagesContainer.append(
                                `<div class="d-flex justify-content-end py-1">
                            <span class="send-msg">${message.body}</span>
                        </div>`
                            );
                        } else {
                            messagesContainer.append(
                                `<div class="d-flex py-1">
                            <span class="receive-msg">${message.body}</span>
                        </div>`
                            );
                        }


                    });
                    scrollToBottom()
                },
                error: function (error) {
                    console.error('Error fetching messages:', error);
                }
            });
        }

        setInterval(fetchMessages, 5000);
    </script>
@stop
