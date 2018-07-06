 @extends('layouts.master') @section("content")

<form method="post" action="/posts/store">
    @csrf

    <div class="form-group">
        <label for="title">標題</label>
        <input type="text" class="form-control" name="title" id="title" value="">
    </div>
    <div class="form-group">
        <label for="category">分類</label>
        <select name="category" class="form-control">
            @foreach(config('app.category') as $k=>$v)
            <option value="{{ $k }}">{{ $v }} </option>
            @endforeach </select>
    </div>
    <div class="form-group">
        <textarea name='content' id="content" class="form-control" rows="5" cols="50"></textarea>
    </div>
    <div class="form-group">
        <label for="files">附件</label>
        <input type="file" class="form-group" name="files[]" id="files" multiple>
    </div>
    <div class="form-group">
        <input type="submit" value="新增" class="btn btn-primary">
    </div>
</form>
@endsection
