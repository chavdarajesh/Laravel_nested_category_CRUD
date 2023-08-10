@extends('layouts.app')
@section('context')
    <div>
        <h1>Add Categories</h1>
    </div>
    <form id="categories_form" method="post" action="{{ route('categories.store') }}">
        @csrf
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input value="{{old('category_name')}}" name="category_name" type="test" class="form-control" id="category_name" aria-describedby="category_name">
                <span class="text-danger" id="error_category_name">@error('category_name') {{ $message }} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="parent_category_id" class="form-label">Parent Category</label>
            <select {{ count($categories) == 0 ? 'disabled' : '' }} name="parent_category_id" class="form-select"
                aria-label="Default select example">
                <option selected disabled>Select Parent Category</option>
                @foreach ($categories as $categorie)
                    <option {{old('parent_category_id') == $categorie->id ? 'selected' : ''}} value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                @endforeach
            </select>
            @error('parent_category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
        <a href="{{ route('categories.list') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
@section('script')
<script>

    $(document).ready(function() {
        $('#categories_form').submit(function(e) {
            e.preventDefault();
            let category_name = $('#category_name').val().trim();
            let regex= /^[a-zA-Z]+$/;
            if(!category_name.match(regex)){
                $('#error_category_name').html('Please Enter Only Alphabetic Characters!')
                return
            }else{
                $(this).unbind('submit').submit();
            }
        })
    })
</script>
@endsection
