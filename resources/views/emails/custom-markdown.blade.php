{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Email Template</title>
</head>

<body>

    {{-- Displaying title and body from mailData --}}
    {{-- <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p> --}}

    {{-- Displaying the generated password --}}
    {{-- <p>Your password: {{$mailData['yourpass']}}</p> --}}

    {{-- Alternatively, you can also directly use $password --}}
    <p>Your password: {{ $password }}</p>


    <p>Thank you.</p>
</body>

</html>
