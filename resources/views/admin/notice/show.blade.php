@extends('adminlte::page')

@section('title', 'Notice')

@section('content_header')

@stop
<style>
    .header-content {
        color: Blue;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        font-size: 24px;
        line-height: 36px;
        font-weight: 500;
        border-bottom: 1px solid #D5D5D5;
    }

    .icon {
        background-color: #D5D5D5;
        padding: 9px;
        border-radius: 50%;
        font-size: 20px
    }

    .notice-section {
        width: 1700px;
        /* width: 900px; */
        margin-top: 40px;
        margin-left: 40px;
        /* display: grid;
        grid-template-columns: 1fr;
        gap: 20px; */
    }

    .notice-box {
        width: 900px;
        border: 1px solid#D5D5D5;
        font-size: 15px;
        padding: 20px;
        border-radius: 8px;
    }

    .notice-header {
        padding: 10px 0 10px 0;
        display: flex;
        justify-content: space-between;
        gap: 10px;
        border-bottom: 1px solid #D5D5D5;
    }

    .notice-info p {
        padding-top: 10px;
        color: #023E7D;
    }

    .notice-header .title,
    .date {
        color: #C2699E;
    }

    .button {
        padding: 20px 0 0 40px;
    }
</style>

@section('content')

    <div class="header-content">
        <div class="header">Notice Board</div>
        {{-- <div class="icon"><i class="fas fa-volume-up" style="color: #0466C8CC;"></i> </div> --}}
    </div>

    <div class="notice-section">
        <div class="notice-box">
            <div class="notice-header">
                <div class="title">
                    {{ $notice->title }} </div>
                <div class="date">
                    <i class="fas fa-calendar-alt"></i> {{ $notice->date }}
                </div>
            </div>
            <div class="notice-info">
                <p>
                    {{ $notice->description }}
                </p>
            </div>

        </div>


    </div>
    <a href="{{ route('notice.index') }}">
        <div class="button">
            <button class="btn btn-primary" type="submit">Back</button>
        </div>
    </a>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
