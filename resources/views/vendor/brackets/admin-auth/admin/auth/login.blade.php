@extends('brackets/admin-ui::admin.layout.master')

@section('title', 'InSigns - Acceso')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" id="app" style="min-height: 100vh; background: #f4f7f6;">
    <div class="row justify-content-center w-100">

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 12px; font-size: 0.85rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-11 col-lg-10 col-xl-9">
            <div class="card shadow-2xl border-0 overflow-hidden" style="border-radius: 30px; min-height: 600px; background: #fff;">
                <div class="row no-gutters" style="min-height: 600px;">
                    
                    <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center p-5" style="background: #3f4691; min-height: 600px;">
                        <div class="text-center">
                            <img src="{{ asset('images/Logo__InSigns__sinfondo.png') }}" alt="InSigns Logo" class="img-fluid" style="max-width: 720px; height: auto; filter: drop-shadow(0px 10px 15px rgba(0,0,0,0.3));">
                        </div>
                    </div>

                    <div class="col-md-7 col-12 p-4 p-lg-5 d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-center mb-5">
                            <div class="bg-light p-1 d-flex" style="border-radius: 50px; width: 280px; border: 1px solid #eee;">
                                <button type="button" id="btn-login" class="btn btn-sm flex-fill shadow-sm" style="border-radius: 50px; background: #3f4691; color: white; transition: 0.3s;">Entrar</button>
                                <button type="button" id="btn-register" class="btn btn-sm flex-fill" style="border-radius: 50px; color: #3f4691; transition: 0.3s;">Crear Cuenta</button>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div id="login-section" style="width: 100%;">
                                <h3 class="text-center mb-4 font-weight-bold" style="color: #333;">Bienvenido de nuevo</h3>
                                <form method="POST" action="{{ route('user.login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="small font-weight-bold text-muted">CORREO ELECTRÓNICO</label>
                                        <input type="email" name="email" class="form-control border-0 bg-light" style="border-radius: 12px; padding: 25px 15px;" placeholder="ejemplo@insigns.com">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold text-muted">CONTRASEÑA</label>
                                        <input type="password" name="password" class="form-control border-0 bg-light" style="border-radius: 12px; padding: 25px 15px;" placeholder="••••••••">
                                    </div>
                                    <button type="submit" class="btn btn-block shadow-lg text-white" style="border-radius: 15px; background: #3f4691; padding: 15px; font-weight: 700;">INGRESAR</button>
                                </form>
                            </div>

                            <div id="register-section" style="display: none; opacity: 0; width: 100%;">
                                <!-- <h3 class="text-center mb-4 font-weight-bold" style="color: #333;">Únete a InSigns</h3> -->
                                <form method="POST" action="{{ url('/admin/register') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="small font-weight-bold text-muted">NOMBRE COMPLETO</label>
                                        <input type="text" name="name" class="form-control border-0 bg-light" style="border-radius: 12px; padding: 12px;" placeholder="¿Cómo te llamas?">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small font-weight-bold text-muted">CORREO ELECTRÓNICO</label>
                                        <input type="email" name="email" class="form-control border-0 bg-light" style="border-radius: 12px; padding: 12px;" placeholder="tu@correo.com">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="small font-weight-bold text-muted">CONTRASEÑA</label>
                                        <input type="password" name="password" class="form-control border-0 bg-light" style="border-radius: 12px; padding: 12px;" placeholder="Mínimo 8 caracteres">
                                    </div>
                                    <button type="submit" class="btn btn-block shadow-lg text-white" style="border-radius: 15px; background: #28a745; padding: 15px; font-weight: 700;">REGISTRARME</button>
                                </form>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <p class="text-muted small mb-3">O continúa con tu cuenta de</p>
                            <a href="{{ url('admin/login/google') }}" class="btn btn-outline-light border btn-block d-flex align-items-center justify-content-center shadow-sm" style="border-radius: 15px; padding: 12px; color: #555;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48" style="margin-right: 12px;">
                                    <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                                    <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                                    <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                                    <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                                </svg>
                                <span class="font-weight-bold">Google</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    const bLogin = document.getElementById('btn-login');
    const bRegister = document.getElementById('btn-register');
    const lSec = document.getElementById('login-section');
    const rSec = document.getElementById('register-section');

    bRegister.addEventListener('click', () => {
        gsap.to(bRegister, {backgroundColor: "#3f4691", color: "#fff", duration: 0.3});
        gsap.to(bLogin, {backgroundColor: "transparent", color: "#3f4691", duration: 0.3});
        
        gsap.to(lSec, {opacity: 0, y: 10, duration: 0.3, onComplete: () => {
            lSec.style.display = 'none';
            rSec.style.display = 'block';
            gsap.fromTo(rSec, {opacity: 0, y: -10}, {opacity: 1, y: 0, duration: 0.3});
        }});
    });

    bLogin.addEventListener('click', () => {
        gsap.to(bLogin, {backgroundColor: "#3f4691", color: "#fff", duration: 0.3});
        gsap.to(bRegister, {backgroundColor: "transparent", color: "#3f4691", duration: 0.3});
        
        gsap.to(rSec, {opacity: 0, y: 10, duration: 0.3, onComplete: () => {
            rSec.style.display = 'none';
            lSec.style.display = 'block';
            gsap.fromTo(lSec, {opacity: 0, y: -10}, {opacity: 1, y: 0, duration: 0.3});
        }});
    });
</script>
@endsection