@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Car Requests List</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </thead>
                            <tbody>
                            @foreach($requestedCars as $requestedCar)
                                <tr>
                                    <td>{{ $requestedCar->id }}</td>
                                    <td>{{ $requestedCar->brand }}</td>
                                    <td>{{ $requestedCar->model }}</td>
                                    <td>{{ $requestedCar->name }}</td>
                                    <td>{{ $requestedCar->phone }}</td>
                                    <td>{{ $requestedCar->email }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $requestedCars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection()

