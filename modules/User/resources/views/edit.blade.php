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
                           placeholder="Họ Tên ..." value="{{old('name')?? $user->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Email</label>
                    <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email ..." value="{{old('email') ?? $user->email}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mp-3">
                    <label for="">Nhóm</label>
                    <select  name="group_id" id=" " class="form-select @error('group_id') is-invalid @enderror" >
                        <option value="0">Chọn Nhóm</option>
                        <option value="1">Chọn Nhóm1</option>
                        <option value="2">Chọn Nhóm1</option>
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
                    <label for="">Mật khẩu</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu ..." value="">
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">Lưu </button>
            <a href="{{route('admin.users.index')}}" class="btn btn-primary">Hủy</a>
        </div>

    </form>

@endsection
