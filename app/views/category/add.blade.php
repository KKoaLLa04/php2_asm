@extends('layout/layout.blade.php')

@section('content')
    <a href="list-category" class="btn btn-primary">Quay lai</a>
    <hr>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <form action="post-category" method="POST" class="mb-3">
        <label for="">Tiêu đề danh mục</label>
        <input type="text" placeholder="Tiêu đề danh mục...." name="title" class="form-control" value="{{!empty($old['title'])?$old['title']:false}}">
        <p style="color: red">{{!empty($errors['title'])?$errors['title']:false}}</p>

        <button type="submit" class="btn btn-success">Đồng ý</button>
    </form>
@endsection