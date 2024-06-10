@extends('layout.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Tên</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Họ Tên ..." value="{{old('name')?? $categories->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Slug</label>
                    <input name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="slug ..." value="{{old('slug') ?? $categories->email}}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Cha</label>
                    <select  name="parent_id" id=" " class="form-select @error('group_id') is-invalid @enderror" >
                        <option value="0">Chọn Nhóm</option>
                    </select>
                    @error('parent_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">Lưu </button>
            <a href="{{route('admin.categories.index')}}" class="btn btn-primary">Hủy</a>
        </div>

    </form>

@endsection
