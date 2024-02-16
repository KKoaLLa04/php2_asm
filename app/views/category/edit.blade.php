@extends('layout/layout.blade.php')

@section('content')
    <a href="{{BASE_URL}}list-category" class="btn btn-primary">Quay lai</a>
    <hr>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <form action="{{BASE_URL}}post-editcate/{{$cateDetail->id}}" method="POST" class="mb-3">
        <label for="">Tiêu đề danh mục</label>
        <input type="text" placeholder="Tiêu đề danh mục...." name="title" class="form-control" value="{{$cateDetail->title}}">
        <p style="color: red">{{!empty($errors['title'])?$errors['title']:false}}</p>

        <button type="submit" class="btn btn-success">Đồng ý</button>
    </form>
@endsection