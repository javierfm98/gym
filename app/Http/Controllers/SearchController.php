<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\User;
use App\Reservation;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request){
       
       if($request->ajax()){
            $name = $request->search;
            $salida = "";

            if(url()->previous() == "http://64.225.72.59/reservations"){

                if($name == null){
                    $clients = User::all();
                    foreach($clients as $client){
                        $salida.='<tr>
                            <td>' .$client->name.  '</td>
                            <td>
                               <div class="d-flex flex-row-reverse">
                                <form action="/admin-reservation" method="POST">
                                     '.csrf_field().'
                                    <input type="hidden" value='.$client->id.' name="cliente_id">
                                    <input type="hidden" name="training_id" id="training_id" class="entreno">
                                    <input type="hidden" name="current_date" id="current_date" class="current_date">
                                    <button type="submit" class="border-0 bg-white pr-4" data-toggle="tooltip" data-placement="top" title="Añadir"> <i class="fas fa-plus fa-fw"></i> </button>
                                </form>   
                               </div>
                            </td>
                         </tr>
                         <tr class="spacer-modal"></tr>';
                    } 

                    $salida.='<img onerror="func2(this)" src="" style="display:none">';                
                }else{

                    $clients = User::name($name)->get();

                    if($clients->count() > 0){
                        foreach($clients as $client){
                            $salida.='<tr>
                                <td>' .$client->name.  '</td>
                                <td>
                                   <div class="d-flex flex-row-reverse">
                                    <form action="/admin-reservation" method="POST">
                                        '.csrf_field().'
                                        <input type="hidden"  value='.$client->id.' name="cliente_id">
                                        <input type="hidden" name="training_id" id="training_id" class="entreno">
                                        <input type="hidden" name="current_date" id="current_date" class="current_date">
                                        <button type="submit" class="border-0 bg-white pr-4" data-toggle="tooltip" data-placement="top" title="Añadir"> <i class="fas fa-plus fa-fw"></i> </button>
                                    </form>   
                                   </div>
                                </td>
                             </tr>
                             <tr class="spacer-modal"></tr>';
                        }

                        $salida.='<img onerror="func2(this)" src="" style="display:none">';
                    }else{
                        $salida = ' <tr>
                                        <td>  No hay clientes con ese nombre  </td>
                                    </tr>';
                    }

                }
            }

            return $salida;
           
       }

         
    }

}
