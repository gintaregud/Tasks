@extends('layouts.app')
@section('content')
<div class="card-body">
    <label>Pasirinkite statusa:</label>
    <form class="form-inline" style="margin-right:4px;" action="{{ route('task.index') }}" method="GET">
        <select name="status_id" id="" class="form-control">
            <option value="" selected>Visos</option>
            @foreach ($statuses as $status)
            <option value="{{ $status->id }}"
                @if($status->id == app('request')->input('status_id'))
                    selected="selected"
                @endif>{{ $status->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary" style="display:inline-block;margin:4px;">Filtruoti</button>
    </form>
</div>
<div class="card-body">
    <table class="table">
        <tr>
            <th>Pavadinimas:</th>
            <th>Aprašymas:</th>
            <th>Statusas:</th>
            <th></th>
        </tr>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->task_name }}</td>
            <td>{!! $task->task_description !!}</td>
            <td>{{ $task->add_date }}</td>
            <td>{{ $task->status->name }}</td>
            <td>
                <a class="btn btn-success" style="display:inline-block;margin:4px;" href="{{ route('task.edit', $task->id) }}">Redaguoti</a>
                <form action="{{ route('task.destroy', $task->id) }}" style="display:inline-block;margin:4px;" method="POST">
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('task.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection