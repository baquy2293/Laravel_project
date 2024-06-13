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
                    <input name="slug" class="form-control slug @error('slug') is-invalid @enderror"
                           placeholder="Slug ..." value="{{old('slug')}}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id=" " class="form-select @error('teacher_id') is-invalid @enderror">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Bá Quý</option>

                    </select>
                    @error('group_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Mã khóa học </label>
                    <input name="code" type="text" class="form-control @error('code') is-invalid @enderror"
                           placeholder="Mã khóa học ..." value="{{old('code')}}">
                    @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mp-3">
                    <label for="">Giá khóa học</label>
                    <input name="price" type="text" class="form-control @error('price') is-invalid @enderror"
                           placeholder="Giá khóa học ..." value="{{old('price')}}">
                    @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Giá khuyến mãi </label>
                    <input name="discount" type="text" class="form-control @error('discount') is-invalid @enderror"
                           placeholder="Khuyến mãi khóa học ..." value="{{old('discount')}}">
                    @error('discount')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Tài liệu đi kèm</label>
                    <select name="doccument" id=" " class="form-select @error('doccument') is-invalid @enderror">
                        <option value="0">Chọn tài liệu</option>
                    </select>
                    @error('doccument')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Trạng thái </label>
                    <select name="status" id=" " class="form-select @error('status') is-invalid @enderror">
                        <option value="0">Chưa ra mắt</option>
                        <option value="1">Đã ra mắt</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mp-3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="support" type="text" class="form-control @error('code') is-invalid @enderror"
                              placeholder="Hỗ trợ..." value="{{old('code')}}"></textarea>
                    @error('code')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mp-3">
                    <label for="">Nội dung</label>
                    <textarea name="content" type="text" class="form-control @error('content') is-invalid @enderror"
                              placeholder="Nội dung..." value="{{old('content')}}"></textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-5">
                            <label for="">Ảnh đại diện</label>
                            <input name="thubnail" type="text"
                                   class="form-control @error('thubnail') is-invalid @enderror"
                                   placeholder="Ảnh đại diện ..." value="{{old('thubnail')}}">
                            @error('thubnail')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-save"></i>
                                Thêm vào
                            </button>
                        </div>
                        <div class="col-2 d-grid">
                            <img
                                src="https://photo.znews.vn/w660/Uploaded/qhj_yvobvhfwbv/2018_07_18/Nguyen_Huy_Binh1.jpg"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="{{route('admin.courses.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection

@section('stytesheets')
    <style>
        img {
            max-width: 100px;
            height: auto;
        }
    </style>

@endsection
