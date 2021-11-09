
<!DOCTYPE html>
<html lang="en">
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
	<title>Activar cuenta</title>
</head>
<body>
	<div class="bg-blue">
		<div class="data-box">
			<div class="data-wrapper">
				Para activar su cuenta escriba una contraseña.

               <form>
                  <div class="input-container">
                     <div class="input-box-100 field-outlined">
                        <input type="text" class="input" required>
                        <label for="" class="label">Contraseña</label>
                     </div>
                     <div class="input-box-100 field-outlined">
                        <input type="text" class="input" required>
                        <label for="" class="label">Confirmar contraseña</label>
                     </div>
                  </div>
					<div>
						<button class="button button-primary button-100">Activar cuenta</button>
					</div>
               </form>
			</div>			
		</div>		
	</div>
</body>
</html>
