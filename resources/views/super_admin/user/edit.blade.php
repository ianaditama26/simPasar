@extends('template.coreTemplate')
@section('title', 'Edit Data User')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('super_admin.user.index') }}">Master User</a></div>
      <div class="breadcrumb-item">Edit Data User</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Edit Data</h4>
            </div>
            <div class="card-body">
            <form action="{{ route('super_admin.user.update', $user->id) }}" method="post">
            @csrf
            @method('put')
               <div class="form-group row">
                  <label for="name" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ $user->name }}">
                     @error('name')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $user->email }}">
                     @error('email')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                     <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" value="{{ old('password') }}">
                     @error('password')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                     <strong class="text-warning">Biarkan kosong, kalau tidak ganti password</strong>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('Pasar') }}</label>
                  <div class="col-sm-10">
                     <select name="pasar_id" id="" class="form-control @error('pasar_id') is-invalid @enderror">
                        <option value="{{ $user->pasar->id }}">{{ $user->pasar->namaPasar }}</option>
                        <option value=""></option>
                        @foreach($pasars as $pasar)
                           <option value="{{ $pasar->id }}">{{ $pasar->namaPasar }}</option>
                        @endforeach
                     </select>
                     @error('pasar_id')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-success">Ubah</button>
            </div>
            </form>
         </div>
      </div>
   </div>
@endsection