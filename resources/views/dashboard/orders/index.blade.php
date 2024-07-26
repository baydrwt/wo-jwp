@extends('dashboard.layouts.main')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show col-lg-8 mt-3 ms-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom container">
    <div class="container list-booking">
        <h2 class="mt-3 fw-bolder">All Orders</h2>
        <div class="card-body mt-5">
            <table class="table table-striped" id="data-table">
                <thead>
                    <th data-column="no">No</th>
                    <th data-column="name">Name</th>
                    <th data-column="product">Email</th>
                    <th data-column="phone">Phone</th>
                    <th data-column="package">Package</th>
                    <th data-column="date">Date</th>
                    <th data-column="insert_date">Insert Date</th>
                    <th data-column="status">Status</th>
                    <th data-column="action">Action</th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->name_package }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->insert_date }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form action="{{ route('approve.by.admin', ['order' => $order->id]) }}" method="POST" >
                                    @method('put')
                                    @csrf
                                    <div class="box-approve d-flex flex-column gap-2">
                                        @if($order->status != 'pending')
                                            <button class="btn btn-success btn-accept btn-data" name="status" value="success" disabled>Approve</button>
                                            <button class="btn btn-danger btn-reject btn-data" name="status" type="submit" value="rejected" disabled>Reject</button>
                                        @else
                                            <button class="btn btn-success btn-accept btn-data" name="status" value="success">Approve</button>
                                            <button class="btn btn-danger btn-reject btn-data" name="status" type="submit" value="rejected">Reject</button>
                                        @endif
                                    </div>
                                </form>   
                            </td>
                            <td>
                                <form action="{{ route('destroy', ['order' => $order->id]) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection