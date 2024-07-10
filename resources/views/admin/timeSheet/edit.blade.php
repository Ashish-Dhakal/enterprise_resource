@extends('adminlte::page')

@section('title', 'Edit Time Sheet')

<!-- @section('content_header')

@stop -->

<style>
    .fa-arrow-left {
        padding: 10px;
        border: 1px solid #D5D5D5;
        border-radius: 50%;
        color: #C2699E;
        borderbu
    }

    .buttom-button {
        display: flex;
        justify-content: space-between;

    }

    .totalhrs {
        background-color: #D0E8FF;
        border-radius: 8px;
        padding: 10px
    }

    .time {
        color: #C2699E;
    }
</style>

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <div class="container ">

        <div class="head-contain ">
            <i class=" fas fa-arrow-left mt-4"></i> <span class="pl-4" style="font-size: 20px; color:#023E7D;">Time Sheet
                Details</span>
        </div>


        <div class="form-row">

            <div class="form-group col-md-4 mt-3">
                <label for="projectName">Project Name * </label>
                <input type="text" class="form-control" id="projectName" name="projectName"
                    value="{{ old('projectName') }}" required>
            </div>

            <div class="form-group col-md-4 mt-3">
                <label for="task">Task *</label>
                <select class="form-control" id="task" name="task" required>
                    <option value="">----</option>
                    <option value="">Task One</option>
                    <option value="">Task Two</option>
                    <!-- Add more options if needed -->
                </select>
            </div>

            <div class="form-group col-md-4 mt-3">
                <label for="startDate">Start Date *</label>
                <input type="date" value="{{ old('startDate') }}" class="form-control" id="startDate" name="startDate"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-4 mt-3">
                <label for="endDate">End Date *</label>
                <input type="text" class="form-control" id="endDate" name="endDate" value="{{ old('endDate') }}"
                    required>
            </div>

            <div class="form-group col-md-4 mt-3">
                <label for="startTime">Start Time *</label>
                <input type="text" class="form-control" id="startTime" name="startTime" value="{{ old('startTime') }}"
                    required>
            </div>

            <div class="form-group col-md-4 mt-3">
                <label for="endTime">End Time *</label>
                <input type="text" class="form-control" id="endTime" name="endTime" value="{{ old('endTime') }}"
                    required>
            </div>

        </div>

        <div class="form-row">
            <label for="description"> Description *</label>
            <textarea class="form-control" value="{{ old('description') }}" name="description" id="description" cols="30"
                rows="5" placeholder="For eg :Feeling not well"></textarea>
        </div>

        <div class="buttom-button mt-4">
            <div class="totalhrs">
                <i class="far fa-clock"></i> Total Hours : <span class="time">6hrs 30min</span>
            </div>
            <div class="action-btn">
                <button class="btn btn-primary">Save <i class="far fa-save"></i></button>
                <button class="btn btn-primary"> Cancel</button>

            </div>

        </div>


    </div>

    </div>

    <!-- Bootstrap JS and dependencies -->

    </body>

    </html>
@stop

@section('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')



@stop
