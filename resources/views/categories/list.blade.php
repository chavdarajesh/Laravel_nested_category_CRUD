@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('context')
    <div>

        <div style="d-flex">
            <a href="{{route('categories.list')}}"><h1>Categories List</h1></a>
            <a class="btn btn-primary" href="{{ route('categories.create') }}">Add category</a>
        </div>
        <div class="mt-5">
            <table id="categories_tabel">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Categories Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                        <tr>
                            <td>{{ $categorie->id }}</td>
                            <td>{!! count($categorie->childern) > 0 ? '<a href="'.route('categories.list',$categorie->id).'">'.$categorie->category_name.'</a>': $categorie->category_name !!}</td>
                            <td><a class="btn btn-primary" href="{{route('categories.edit',$categorie->id)}}">Edit</a> | <a class="btn btn-danger" href="{{route('categories.delete',$categorie->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        let table = new DataTable('#categories_tabel');
    </script>
@endsection
