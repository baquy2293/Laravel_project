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
                    <input name="name" type="text" class="form-control title @error('name') is-invalid @enderror"
                           placeholder="Họ Tên ..." value="{{old('name')}}">
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
                    <input name="slug" class="form-control slug @error('slug') is-invalid @enderror" placeholder="slug ..."
                           value="{{old('slug')}}">
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
                    <select name="parent_id" id=" " class="form-select @error('parent_id') is-invalid @enderror">
                     <option value="0">Khong</option>
                      {{getCategories($categories,old('parent_id'))}}
                    </select>
                    @error('group_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection
