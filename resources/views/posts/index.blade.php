@extends('layouts.master') @section('content') @isset($err_delete)
<h1 class="text-center">{{$err_delete}}</h1>
@endisset

<input id="user_id" type="hidden" value="@auth {{ Auth::user()->id }} @endauth">

<div class="row justify-content-center mt-1">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">最新公告</div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>公告主題(點擊觀看細節)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td scope="row">
                                <!-- <a href="#" onclick="show_detail({{$post->id}},{{$post->user_id}})">{{ $post->title }}</a> -->
                                <a href="{{route('posts.show',['post'=> $post->id])}}">{{$post->title}}</a>
                            </td>
                            <td>
                                @auth
                                <a href="#" onclick="del_post({{$post->id}});">刪除</a>
                                @endauth
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="delForm" action="" method="post">
    {!! method_field('delete') !!} @csrf
</form>

@endsection @section("script")
<script>
    function show_detail(id, user_id) {
        $.getJSON("/posts/" + id + "/show", function (data) {
            $("#m_post_id").val(id);
            $("#m_title").html(data["title"]);
            $("#category").html(data["category"]);
            $("#content").html(data["content"]);
            $("#modelId").modal('show');
        });
    }

    function update_post() {
        var id = $("#m_post_id").val();
        $("#upForm").attr("action", "/posts/" + id);
        $("#upForm").submit();
    }
    function del_post(id) {
        $("#delForm").attr("action", "/posts/" + id);
        $("#delForm").submit();
    }

</script>
@endsection
