@extends("layouts.master") @section('content') @if($errors->any())
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">關閉</button>
    <strong>請修正以下錯誤</strong>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card mt-1">
    <div class="card-header">
        <h4 class="card-title">觀看公告</h4>
    </div>
    <div class="card-body">
        <form action="{{route('posts.update',['post'=>$post->id])}}" id="upForm" method="post">
            {!! method_field('PATCH') !!} @csrf

            <div class="form-group">
                <label>標題</label>
                <input type="text" name="title" value="{{$post->title}}" @cannot( 'update',$post) readonly @endcannot>
            </div>
            <div class="form-group">
                <label>類別</label>
                <input type="text" name="category" value="{{$post->category}}" @cannot( 'update',$post) readonly @endcannot>
            </div>
            <div class="form-group">
                <textarea name='content' id="content" class="form-control" rows="4" cols="50" @cannot( 'update',$post) readonly @endcannot>{{$post->content}}</textarea>
            </div>


            <div class="form-group">
                @can('update',$post)
                <button type="submit" class="btn btn-primary">更新</button>
                @endcan
                <button type="button" class="btn btn-secondary" onclick="document.location.href='{{ route('posts.index')}}'">回列表</button>
            </div>

        </form>
    </div>
</div>
@endsection
