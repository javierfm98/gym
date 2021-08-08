@extends('layouts.menu')

@section('content')

<style >
    body{
            background: #00b8ff;
         }

         .sidebar{
            min-width: 220px;
            min-height: 100vh;
            padding: 0;
         }

          .sidebar .menu a{
            display: block;
            padding: 10px;
            margin-left: 15px;
            text-decoration: none;
            color: black;
         }

         .sidebar .menu a:hover{
            color: #00b8ff;
         }

         .sidebar .menu a i{
            margin-right: 20px;
         }

         .main{
            width: auto;
            height: auto;
            margin: 20px;
            border-radius: 10px;
         }

         .btn-primary{
             background-color:  #00b8ff;
         }

         .form-group{
            padding-bottom: 15px;
         }


         label{
            margin-bottom: 6px;
         }

          h4{
              text-align: center;
            }

            .rounded-15{
        border-radius: 15px;
        }

        .rounded-10{
        border-radius: 10px;
        }

        @media screen and (max-width: 1300px) {

            .sidebar{
            min-width: auto;
            }
            .sidebar .photo{
            display: none;
            }
            .sidebar .menu a span{
            display: none;
            }
            .sidebar .menu a i{
            margin: 0;
            }
            .sidebar .menu a{
            margin: 0;
            }

           

            
         }
         @media  screen and (max-width: 575px) {

            .sidebar{
            min-height: auto;
            }
            .sidebar .menu a i{
            margin: 0;
            }
            .sidebar hr{
            display: none;
            }

            button{
               width: 100%;
            }

            

         }
             
     



      </style>
 <h4 class="title mt-4 mb-3 mx-4">Dar de alta a un cliente</h4>

 @if ($errors->any())
  <div class="alert alert-danger rounded-10 mx-5 " role="alert">
      {{ $errors->first() }}
  </div>
  @endif

     <div class="new-user container px-3 py-5 ">
         <form action="{{ route('register') }}" method="POST"> 
          @csrf

           <div class="form-group">
            <label for="name">Nombre del cliente</label>
           <input type="text" name="name" class="form-control rounded-15 border border-dark" value="{{ old('name')}}" required autocomplete="name" autofocus>
           </div>

           <div class="form-group">
           <label for="name">Apellidos del cliente</label>
           <input type="text" name="surname" class="form-control rounded-15 border border-dark">
           </div>

           <div class="form-group">
            <label for="email">Correo del cliente</label>
           <input type="email" name="email" class="form-control rounded-15 border border-dark" value="{{ old('email') }}" required autocomplete="email">
           </div>

           <div class="form-group">
            <label for="name">Teléfono del cliente</label>
           <input type="text" name="phone" class="form-control rounded-15 border border-dark">
           </div>

           <div class="form-group">
            <label for="name">Nombre de usuario</label>
           <input type="text" name="username" class="form-control rounded-15 border border-dark">
           </div>

           <div class="form-group">
            <label for="password">Contraseña</label>
           <input type="password" name="password" class="form-control rounded-15 border border-dark" required autocomplete="new-password">
           </div>


              <div class="d-flex mb-4 flex-row-reverse">
                 <button type="submit" class="rounded-10 mt-3 btn btn-primary border-0 px-5">Dar de alta</button>
              </div>

        
      </form> 

      </div>
@endsection
