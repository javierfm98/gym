<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Reservation;
use App\User;
use App\Training;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' , 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $arrayPhrases = $this->getArrayPhrases();

        $phrasesIndex = array_rand($arrayPhrases, 1);

        $phrases = $arrayPhrases[$phrasesIndex];

        $user_id =  auth()->user()->id;
        $currentDate = Carbon::now();

        if(auth()->user()->hasRole(['admin'])){
            $payments = Subscription::take(3)->orderBy('end_at', 'desc')->get();
            $nextPay = 0;
        }else if(auth()->user()->hasRole(['trainer'])){
            $trainingsTrainer = Training::where('user_id', $user_id)->whereDate('day' , '>=' , $currentDate)->orderBy('day', 'desc')->take(3)->get();    
        }else{
            $payments = Subscription::where('user_id', $user_id)->orderBy('end_at' , 'desc')->take(3)->get();
            $currentDay = Carbon::now();
            $end_at = $payments->first()->end_at;
            $nextPay = $currentDay->diffInDays($end_at);

            if($end_at->lt($currentDay)){
                $nextPay = $nextPay * (-1);
            }
        }

        
        $reservation = Reservation::where('user_id' ,  $user_id)->get(['training_id']);
        $trainings = Training::whereIn('id' , $reservation)->whereDate('day' , '>=' ,  $currentDate)->take(3)->get();

        return view('home.index', compact('payments', 'trainings', 'phrases', 'nextPay', 'trainingsTrainer'));
    }


    public function getArrayPhrases(){

        $array = [
            "Para ser el número uno, tienes que entrenar como si fueras el número dos.",
            "La diferencia entre quién eres y quién quieres ser es aquello que haces.",
            "El fitness no es un destino, es una forma de vida.",
            "La distancia entre los sueños y la realidad se llama disciplina.",
            "La realidad es bastante simple, lo haces o no lo haces.",
            "Cuida de tu cuerpo. Es el único lugar que tienes para vivir.",
            "Si fuera fácil todos serían buenos.",
            "Trabajo duro y entrenar. No hay fórmula secreta",
            "No digas más mañana.",
            "No te vayas dejando algo sin terminar.",
            "El dolor es temporal, el orgullo para siempre.",
            "Solo los caminos duros llevan a la grandeza",
            "Cuanto más sudas en el entrenamiento, menos sangras en el combate.",
            "Cuando pienses en abandonar, piensa porqué empezaste.",
            "Cuando comienza a doler es cuando comienza la sesión.",
            "Pensar en ir al gimnasio quema entre 0 y 0 calorías.",
            "Si quieres verme conseguir algo, dime que no puedo hacerlo.",
            "La pregunta no es quién me va a dejar, es quién me va a parar.",
            "Siempre parece imposible hasta que se hace.",
            "Si realmente quieres hacer algo, encontrarás una forma. Si no, encontrarás una excusa.",
            "Si los obstáculos son largos, salta con más energía.",
            "No se trata de si fracasas, se trata de si eres capaz de levantarte.",
            "El único lugar donde el éxito viene antes del trabajo es en el diccionario.",
            "La mejor forma de predecir tu futuro es crearlo.",
            "Rendirse es renunciar a lo que quieres. Si lo haces, es porque no lo quieres con todo tu corazón.",
            "Cuidado con las excusas, son mentiras que te alejan de tus sueños.",
            "Nunca tires la toalla. Úsala para secar tu sudor y sigue adelante.",
            "Cuando tus piernas y tu cabeza no puedan más... tu corazón hará el resto.",
            "No eres lo que logras, eres lo que superas.",
            "Queda estrictamente prohibido rendirse.",
            "Los ganadores se ponen metas, los perdedores excusas.",
            "Insistir, persistir, resistir y nunca desistir.",
            "Mi objetivo no es vencer a los demás. Es vencerme a mí mismo.",
            "El cuerpo consigue lo que la mente cree.",
            "Sigue corriendo, no dejes que tus excusas te alcancen."
        ];

        //35

        return $array;





    }
}
