@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redagavimas</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('task.update', $task->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label>Pavadinimas: </label>
                            <input type="text" name="task_name" class="form-control" value="{{ $task->task_name}}">
                            @error('task_name')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                           <label>Aprašymas: </label>
                           <textarea id="mce" name="task_description" rows=10 cols=100 class="form-control">{{ $task->task_description}}</textarea>
                           @error('task_description')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Altikti iki: </label>
                            <input type="text" name="add_date" class="form-control" value="{{ $task->add_date}}">
                            @error('add_date')
                                <br><div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Statusas: </label>
                            <select name="status_id" id="" class="form-control @error('status_id') is-invalid @enderror">
                                 <option value="" selected disabled>Pasirinkite</option>
                                 @foreach ($statuses as $status)
                                 <option value="{{ $status->id }}" @if($status->id == $task->status_id) selected="selected" @endif>{{ $status->name }}</option>
                                 @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Issaugoti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection