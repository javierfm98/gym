<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- <link href="{{ asset('/css/styles.css')}}" rel="stylesheet" type="text/css"> -->

     

      <title>Inicio de sesión</title>
      <style>
         body{
          margin: 0;
          padding: 16px;
         background: #00b8ff;
          font-family: "Poppins", sans-serif !important;
         }

         .container{
            margin-top: 20px;
            max-width: 400px;
            height: 275px;
            border-radius: 15px;
         }

         .rounded-10{
        border-radius: 10px;
        }

        .olvidar{
          color:  #00b8ff;
          text-decoration:none;
          font-size: 85%;
          margin-left: 25px;
        }

      .boton{
      cursor: pointer;
      border: none;
      white-space: normal;
      letter-spacing: .25px;
      font-weight: 400;
      font-size: 14px;
     padding: 10px 50px;
      border-radius: 4px;
      line-height: 20px;
      min-width: 88px;
      transition: .25s;
      display: inline-block;
      color: #fff;
    }


      .boton-primary{
      background-color: #1a73e8;
      background-color: #00b8ff;
      color: #fff;
    }

        .boton-primary:hover{
            box-shadow: 0 1px 1px 0 rgb(66,133,244, .8),
            0 1px 3px 1px rgb(66,133,244, .5);
            background-color: #287ae6;
    }

/* MATERIAL */


 .field-outlined {
  display: block;
  position: relative;
}

  .input {
  width: 100%;
  height: 40px;
  font-size: 16px;
  font-weight: 500;
  color: rgba(0, 0, 0, 0.87);
  outline: none;
}

  .label {
  font-size: 16px;
  font-weight: 500;
  color: rgba(0, 0, 0, 0.6);
  pointer-events: none;
  transition: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  position: absolute;
  top: 8px;
  left: 40px;
}


 .input:focus ~ .label, .input:valid ~ .label {
  background: #ffffff;
  top: -8px;
  left: 30px;
  font-size: 12px;
  padding: 0 8px;
}

.input {
  padding: 0 16px;
  border-radius: 6px;
  border: 1px solid rgba(0, 0, 0, 0.22);
}

 .input:hover {
  border-color: rgba(0, 0, 0, 0.42);
}

 .input:focus {
  border: 2px solid #1a73e8;
}

 .input:focus ~ .label {
  color: #1a73e8;
}



    .input-date{
      padding: 10px;
      padding-left: 44%;
      color: rgba(0, 0, 0, 0.6);
    }

    .input-date::before{
      top: 15px !important ;
      color: rgba(0, 0, 0, 0.6) !important;
    }

  /***********************************************/

    .img-container {
        text-align: center;
    }


      
      </style>
   </head>
   <body>

      @if ($errors->any())
                <div class="alert alert-danger rounded-10 mx-5 " role="alert">
                    {{ $errors->first() }}
                </div>
            @endif
        <div class="img-container"> 
           <img src="{{ asset('img/logo_white.svg') }}" width="150" height="150" alt="Logo">
        </div>
        
      <div class="container bg-white">
         <h4 class="fw-bold text-center pt-3 mb-4">Iniciar sesión</h4>
            <form method="POST" action="{{ route('login') }}">
            @csrf
             <div class=" col-md-12 field-outlined px-4 mb-3">
               <input type="text" name="email" class="input"  value="{{ old('email') }}" required autocomplete="email" autofocus="">
               <label for="" class="label">Correo electrónico</label>
            </div>

            <div class=" col-md-12 field-outlined px-4">
               <input type="password" name="password" class="input" required>
               <label for="" class="label">Contraseña</label>
            </div>

              <div class="mt-2">
                    <a href="{{ route('password.request') }}" class="olvidar">He olvidado mi contraseña</a>
              </div>

             <div class="form-group col-md-12 px-4 mt-3" id="login">
                <input type="submit" class="boton boton-primary" style="width: 100%;" value="Entrar">
             </div>

         </form>
      </div>

   </body>
</html>
