<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style type="text/css">
      body {
        width: 790px;  
        height: 1120px; 
        margin: 0 auto; 
        font-family: 'Roboto', 'sans-serif;' !important;
      }

      .logo {
        text-align: center;
        margin-bottom: 10px;
        padding: 10px 0;
        margin-bottom: 30px;
      }

      .logo img {
        width: 90px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      table tr:nth-child(2n-1) td {
        background: rgba(0, 183, 255, 0.1);
      }


      table th {
        padding: 5px 20px;
        border-bottom: 1px solid grey;
        text-align: center;
      }

      table td {
        padding: 20px;
        text-align: center;
      }

      .total{
         border-top: 1px solid grey;
      }     
    </style>
  </head>
  <body>
      <div class="logo">
        <img src="{{ asset('img/logo_black.png') }}">
      </div>
      <table>
        <thead>
          <tr>
            <th>CONCEPTO</th>
            <th>FECHA</th>
            <th>PRECIO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> Pago {{ $payment->rate->name }} </td>
            <td> {{ $payment->end_at->format('d/m/Y') }} </td>
            <td> {{ $payment->rate->price }} € </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr class="total">
            <td>TOTAL</td>
            <td></td>
            <td> {{ $payment->rate->price }} € </td>
          </tr>
        </tbody>
      </table>
  </body>
</html>