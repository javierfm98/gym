<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
    <link href="{{ asset('/css/styles.css')}}" rel="stylesheet" type="text/css">
    <title>Restablecer contraseña</title>
</head>
<body>
    <div class="bg-blue">
        <div class="data-box">
            <div class="data-wrapper">
                Introduzca los datos para restablecer la contraseña
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    @error('email')
                        <span class="custom-alert alert-red">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @error('password')
                        <span class="custom-alert alert-red">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-container">
                        <div class="input-box-100 field-outlined">
                            <input id="email" type="email" class="input" name="email" value="{{ $email ?? old('email') }}" required>
                            <label for="" class="label">Correo electrónico</label>
                        </div>
                        <div class="input-box-100 field-outlined">
                            <input id="password" type="password" type="text" class="input" name="password" required>
                            <label for="" class="label">Contraseña</label>
                        </div>
                        <div class="input-box-100 field-outlined">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                            <label for="" class="label">Confirmar contraseña</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="button button-primary button-100">Restablecer contraseña</button>
                    </div>
                </form>
            </div>          
        </div>      
    </div>
</body>
</html>