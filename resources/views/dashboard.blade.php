@extends('layout')

@section('content')

<div class="row mb-4">
    <div class="col">
        <div class="card p-3 text-center shadow-sm">
            <h5>Total Deposits</h5>
            <h2 class="text-success">{{ $deposits->count() }}</h2>
        </div>
    </div>

    <div class="col">
        <div class="card p-3 text-center shadow-sm">
            <h5>Validated</h5>
            <h2 class="text-primary">
                {{ $deposits->where('status','validated')->count() }}
            </h2>
        </div>
    </div>
</div>

<div class="card shadow-sm p-3">

    <h4 class="mb-3">Deposits List</h4>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Citizen</th>
                <th>City</th>
                <th>Category</th>
                <th>Status</th>
                <th>Weight</th>
            </tr>
        </thead>

        <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <td>{{ $deposit->citizen->name ?? '-' }}</td>
                <td>{{ $deposit->city }}</td>
                <td>{{ $deposit->category->name ?? '-' }}</td>
                <td>
                    <span class="badge bg-info">{{ $deposit->status }}</span>
                </td>
                <td>{{ $deposit->estimated_weight }} kg</td>
            </tr>
        @endforeach
        </tbody>

    </table>

</div>

@endsection