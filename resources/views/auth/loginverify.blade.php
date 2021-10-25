@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{route('verify')}}">
          {{ csrf_field() }}
          <body background="\img\fondo.jpg">
              <div class="card-body">
              <h3 class="text-center bg-success">MULTISERVICIOS VIMEGA</h3>
              <p class="text-center bg-success">TALLER Y REPUESTOS</p>

              <div class="form-group mb-3{{$errors->has('key' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('key')}}" name="key" id="key" class="form-control" placeholder="OTP">
                {!!$errors->first('key','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-success px-4"><i class="fa fa-sign-in fa-2x"></i> Iniciar sesión</button>
                </div>
              </div>
            </div>
          </form>
          </div>

        </div>
      </div>
    </div>
  </body>
@endsection
