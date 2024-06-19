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
                        <option value="0"> Chọn giảng viên</option>
                        <option value="1" {{old('teacher_id')==1 ? 'selected' : false }} >Bá Quý</option>

                    </select>
                    @error('teacher_id')
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
                    <input name="price" type="number" class="form-control @error('price') is-invalid @enderror"
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
                    <input name="sale_price" type="number"
                           class="form-control @error('sale_price') is-invalid @enderror"
                           placeholder="Khuyến mãi khóa học ..." value="{{old('sale_price')}}">
                    @error('sale_price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Tài liệu đi kèm</label>
                    <select name="is_document" id=" " class="form-select @error('is_document') is-invalid @enderror">
                        <option value="0" {{ old('is_document') == 0 ? 'selected' : false }}>Không</option>
                        <option value="1" {{ old('is_document') == 1 ? 'selected' : false }}>Có</option>
                    </select>
                    @error('is_document')
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
                        <option value="1" {{old('status')==1 ? 'selected': false}} >Đã ra mắt</option>
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
                    <textarea name="support" type="text"
                              class="form-control  @error('support') is-invalid @enderror"
                              placeholder="Hỗ trợ...">{{old('support')}}</textarea>
                    @error('support')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mp-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" type="text"
                              class="form-control ckeditor @error('detail') is-invalid @enderror"
                              placeholder="Nội dung...">{{old('detail')}}</textarea>
                    @error('detail')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            {{--            <div class="col-12">--}}
            {{--                <div class="mb-3">--}}
            {{--                    <label for="">Chuyên mục</label>--}}
            {{--                    <div class="list-categories">--}}
            {{--                        {{ getCategoriesCheckbox($categories, old('categories')) }}--}}
            {{--                    </div>--}}
            {{--                    @error('categories')--}}
            {{--                    <div class="invalid-feedback d-block">--}}
            {{--                        {{ $message }}--}}
            {{--                    </div>--}}
            {{--                    @enderror--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-5">
                            {{--                            dung file manager--}}

                            <label for="">Ảnh đại diện</label>
                            <input name="thumbnail" type="text"
                                   class="form-control @error('thumbnail') is-invalid @enderror"
                                   placeholder="Ảnh đại diện ..." value="{{old('thumbnail')}}" id="thumbnail">
                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary" type="button" id="lfm" data-input="thumbnail"
                                    data-preview="holder">
                                <i class="fa fa-save"></i>
                                Thêm vào
                            </button>
                        </div>
                        <div class="col-3 ">
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            @if(old('thumbnail'))
                                <img src="{{ old('thumbnail') }}"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary"> Thêm</button>
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
@section('scripts')
    <script>
        ClassicEditor.create(document.querySelector('.conent'))
            .catch(
                error => {
                    console.error(error);
                }
            );
    </script>
@endsection
