<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Proyecto Final </title>
        <!--Hoja de estilos -->
        <link rel="stylesheet" href="../css/style.css" type="text/css">
        
        <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
        <!-- MDB -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet"/>

    </head>
    <body>
       
        <section class="vh-100">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="../img/inicio.jpg"
                        class="img-fluid rounded-circle" alt="Sample image">
                    </div>
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                      
                        <form name="loginform" id="loginform" action="{{ route('login') }}" method="POST">
                          @csrf

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0">Inicio de Sesión</p>
                            </div>

                            <!-- Usuario Campo -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Usuario" />
                                <label class="form-label" for="form3Example3">{{ __('Email Address') }}</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                                <span id="icon"><i class="fa fa-eye" aria-hidden="true" id="ojo1" onclick='pass();'></i><i class="fa fa-eye-slash" aria-hidden="true" id="ojo2" style="display:none;" onclick='pass();'></i></span>
                                <label for="password" class="form-label" for="form3Example4">{{ __('Password') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrarse</a>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button name="login" type="submit" href="{{ route('login') }}" class="btn btn-primary btn-lg btn-login">{{ __('Ingresar') }} <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                        </form>
                     
                    </div>
                </div>
            </div>
            <div
                class="footer d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                Copyright © 2023 Todos los derechos reservados.
                </div>

            </div>
        </section>
        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
        <!--JS RUTA -->
        <script src="../js/myjs.js"></script>
    </body>
</html>