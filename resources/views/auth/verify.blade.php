<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
     <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <link href="{{ asset('/css/styles.css')}}" rel="stylesheet" type="text/css">
    <title>Verificacion correo</title>
    <style type="text/css">
        body{
            background: #00b8ff !important;
        }
    </style>
</head>

<body>
    <div class="container wrapper mt-5">
        <h4 class="fw-bold pt-3 mb-4">Verifique su correo electrónico</h4>

        <div class=" col-md-12 mb-3">
            @if (session('resent'))
                 <div class="alert alert-success" role="alert">
                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico..') }}
                 </div>
            @endif

            {{ __('Antes de continuar, verifique su correo electrónico para ver si hay un enlace de verificación..') }}
            {{ __('Si no recibió el correo electrónico') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haga clic aquí para solicitar otro') }}</button>.
            </form>
        </div>
    </div>
</body>

</html>