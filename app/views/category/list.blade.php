@extends('layout/layout.blade.php')

@section('content')
    <a href="{{BASE_URL}}add-category" class="btn btn-success">Thêm mới <i class="fa fa-plus"></i></a>
    <hr>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th width="3%">#</th>
                <th>Tiêu đề</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($data))
                @foreach($data as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->title}}</td>
                        <td><a href="{{BASE_URL}}edit-category/{{$item->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{BASE_URL}}delete-category/{{$item->id}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection