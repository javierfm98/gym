<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href="{{ asset('/css/email.css')}}" rel="stylesheet" type="text/css">
	<title>Bienvenido</title>
	<style>
		*{
		  padding: 0;
		  margin: 0;
		  box-sizing: border-box ;
		}


		body {
		  font-family: 'Roboto', 'sans-serif;' !important;
		  background: #ececec;
		}


		.bg-email{
		  background: linear-gradient(to bottom, #00b8ff 20%, #f4f4f4 0%);
		  width: 100vw;
		  height: 100vh;
		  position: relative;
		}

		.email-box{
		  display: flex;
		  justify-content: center;
		  align-items: center;
		}


		.email-wrapper{
		  background: white;
		  width: 85%;
		  max-width: 800px;
		  border-radius: 4px;
		  margin: auto;
		  margin-top: 80px;
		  text-align: justify;
		  padding: 35px;
		}

		.email-header{
		  text-align: center;
		  margin-bottom: 30px;
		  font-size: 22px;
		}

		.email-body{
		  color: #777;
		}

		.email-body p{
		  margin: 10px;
		}

		.email-footer{
		  margin-top: 22px;
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		}

		.email-footer img{
		  width: 150px; 
		  height: 150px;
		  margin-top: 30px;
		}


		.credential{
		  margin-left: 20px; 
		}

		.text-bold{
		  font-weight: bold;
		}

		.warning{
		  display: flex;
		  justify-content: center;
		  margin: 8px;
		  font-size: 13px;
		}

		.button{
		  cursor: pointer;
		  border: none;
		  white-space: normal;
		  letter-spacing: .25px;
		  font-weight: 500;
		  font-size: 14px;
		  padding: 11px 50px;
		  border-radius: 4px;
		  line-height: 20px;
		  min-width: 200px;
		  transition: .25s;
		  color: #fff;
		  margin-right: 15px;
		  text-decoration: none;
		  text-align: center;
		}

		.button-primary{
		  background-color: #00b8ff;
		  color: #fff;
		}

		.button-primary:hover{
		  box-shadow: 0 1px 1px 0 rgb(66,133,244, .8),
		              0 1px 3px 1px rgb(66,133,244, .5);
		  background-color: #287ae6;
		  color: white;
		  text-decoration: none;
		}				
	</style>
</head>
<body>

	<div class="bg-email">
		<div class="email-box">
			<div class="email-wrapper">
				<div class="email-header">
					<h1>Bienvenido!</h1>						
				</div>
				<div class="email-body">
					<p>Estamos emocionados de que empieces. A continuacion le mostraremos su usuario y contraseña:</p>
					<div class="credential">
						<p><span class="text-bold">Correo electrónico:</span> javier@gmail.com</p>
						<p><span class="text-bold">Contraseña:</span> 123456789</p>
						<div class="warning">
						<span>*&nbsp</span>
						<span> Por favor cambia su contraseña en el perfil, al haberse mandado por correo, puede que la seguridad se haya visto comprometida</span>	
						</div>			
					</div>
				</div>
				<div class="email-footer">
					<a href="#" class="button button-primary">Iniciar sesion</a>
					<img src="{{ asset('img/logo_black.svg') }}" alt="Logo"> 					
				</div>

			</div>
		</div>			
	</div>


</body>
</html>