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
        <h2 class="mt-3 fw-bolder">All Katalog</h2>
        <ol class="breadcrumb mb-4">
            <a href="/dashboard/katalogs/create" class="btn btn-primary mb-2 mt-2">Create New Product</a>
        </ol>
        <div class="card-body mt-5">
            <table class="table table-striped" id="data-table">
                <thead>
                    <th data-column="no">No</th>
                    <th data-column="name">Name</th>
                    <th data-column="product">Description</th>
                    <th data-column="price">Price</th>
                    <th data-column="image">Image</th>
                    <th data-column="action">Action</th>
                </thead>
                <tbody>
                    @foreach ($katalogs as $katalog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $katalog->name }}</td>
                            <td>{{ $katalog->description }}</td>
                            <td>{{ number_format($katalog->price, 0, ',', '.') }} IDR</td>
                            <td><img src="{{ asset('storage/' . $katalog->image ) }}" width="100" height="100" alt=""></td>
                            <td>
                                <a href="/dashboard/katalogs/{{ $katalog->id }}/edit" class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('katalogs.destroy', $katalog) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Jika anda menghapus katalog ini, maka akan menghapus order yang menggunakan katalog ini, lanjutkan?')">
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