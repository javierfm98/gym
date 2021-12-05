<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Training;
use App\User;
use App\Reservation;
use App\Setting;
use App\Subscription;
use Carbon\Carbon;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if($user->hasRole(['admin'])){
            $trainings = Training::all();
            $trainings = Training::orderBy('day', 'desc')->paginate(5);                                 
        }else if ($user->hasRole(['trainer'])){
            $trainings = Training::where('user_id' , $user->id)->orderBy('day', 'desc')->paginate(5);
        }

       // dd(url('/'));

        return view('trainings.index' , compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $trainers = User::trainers()->get();

         return view('trainings.create' , compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $schedule = $request->get('schedule');
        $splitHours = explode("-",$schedule);

        if($request->trainer){
           $trainer_id = $request->trainer;
        }else{
           $trainer_id = auth()->user()->id;
        }

        
        $start = new Carbon($splitHours[0]);
        $end = new Carbon($splitHours[1]);


        $flag = true;

        $trainings = Training::where('day' , $request->day)->get();

        foreach($trainings as $training){
            $arrayHours = $this->comprobationArray($training->start , $training->end);
            $flag = $this->coincideHours($arrayHours , $start , $end);
            if(!$flag){
                $notification = 'Imposible crear entreno, las horas coindicen con otro entreno. Por favor, escoja otro horario.';
                return redirect('/trainings/create')->with(compact('notification'));
            }
        }

        if($flag){
            $data  = $request->only('day', 'capacity' , 'description') + [ 'user_id' => $trainer_id , 'start' => $splitHours[0] , 'end' => $splitHours[1] , 'enroll' => 0 ];

            Training::create($data);
       
            $notification = 'Entreno creado correctamente.';
            return redirect('/trainings')->with(compact('notification'));

        }  
    }


    public function comprobationArray($start , $end){

        while ($start <= $end) {

            $intervals[] =   $start->format('H:i'); 
            $start->addMinutes(1);   
        }

        return $intervals;
    }

    public function coincideHours($hours , $start , $end){
        
        $start = $start->addMinutes(1);
        $end = $end->addMinutes(1);

        foreach($hours as $hour){
            $hour = new Carbon($hour);
            if($hour->eq($start) || $hour->eq($end)){
               // print_r($start->format('H:i'));
                return false;
            }
        }

        return true;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = Reservation::where('training_id' , $id)->get();

        $training = Training::findOrFail($id);

       // dd($training->toArray());

        return view('trainings.show' , compact('clients' , 'training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $trainers = User::trainers()->where('id' , '!=' , $training->user_id)->get();

        return view('trainings.edit' , compact('training', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $training = Training::findOrFail($id);

        if($request->trainer){
           $trainer_id = $request->trainer;
        }else{
           $trainer_id = $training->user_id;
        }


        $schedule = $request->get('schedule');
        $splitHours = explode("-",$schedule);

        $start = new Carbon($splitHours[0]);
        $end = new Carbon($splitHours[1]);
         
        $trainings = Training::where('day' , $request->day)->where('id' , '!=' , $training->id)->get();

        $flag = true;

        foreach($trainings as $trainingAll){
            $arrayHours = $this->comprobationArray($trainingAll->start , $trainingAll->end);
            $flag = $this->coincideHours($arrayHours , $start , $end);
            if(!$flag){
                $notification = 'Imposible editar entreno, las horas coindicen con otro entreno. Por favor, escoja otro horario.';
                return redirect('/trainings/'.$training->id.'/edit')->with(compact('notification'));
            }
        }

        if($flag){
            $data = $request->only('day', 'capacity' , 'description') + [ 'user_id' => $trainer_id , 'start' => $splitHours[0] , 'end' => $splitHours[1] ];

            $training->fill($data);
            $training->save(); 

            $notification = 'El entreno se ha actualizado correctamente.';
            return redirect('/trainings')->with(compact('notification'));
        }  

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $reservation = Reservation::where('training_id' , $id)->get();

        if($reservation->isNotEmpty()){
            Reservation::where('training_id' , $id)->delete();
        }

        
        $training = Training::findOrFail($id);
        $training->delete();

        
        $notification = "El entreno se ha eliminado correctamente.";
        return redirect('/trainings')->with(compact('notification'));
    }

    public function hoursList(Request $request){

        if($request->ajax()){

            $date = $request->get('date');
            $schedule = $request->get('schedule');

            $start = Setting::all()->pluck('start')->toArray();
            $end = Setting::all()->pluck('end')->toArray();
            $duration = Setting::all()->pluck('duration')->toArray();
            $salida = '';

            $hoursIntervals = $this->createArrayHours($start[0] , $end[0] , $duration[0] , $date);

            

            if($schedule != null){
                $splitHours = explode("-",$schedule);
                $salida = ' <option value="'.$schedule.'">'.$splitHours[0].' - '.$splitHours[1].'</option>
                            <option disabled>-------------</option>';

            }

            //  $salida = '<option value="" disabled selected></option>';

            foreach($hoursIntervals as $hours){
                $salida.= '<option value="'.$hours['start'].'-'.$hours['end'].'">'.$hours['start'].' - '.$hours['end'].'</option>';
            }              

            return $salida;
        } //Fin if ajax

//    return $hoursIntervals;

    }

    public function createArrayHours($start , $end1 , $duration , $date){

        $start = new Carbon($start);
        $end = new Carbon($end1);

        while ($start < $end) {
            $interval = [];

            $interval['start']  = $start->format('H:i');

             $available = $this->isAvailableHour($date, $start);

           
            $start->addMinutes($duration);
            $interval['end']  = $start->format('H:i');

            if ($available) {
                $intervals []= $interval;           
            }              
        }

        return $intervals;
    }

    public function isAvailableHour($date, Carbon $start) {

        $existsHour = Training::where('day' , $date)
                    ->where('start' , $start->format('H:i:s'))
                    ->exists();

        return !$existsHour; // si no exite signifca que esta disponible 
    }

    public function displayTrainings(Request $request){

        if($request->ajax()){
            $date = $request->date;
            $user_id = auth()->user()->id;
            $salida = "";
            $time = 0.5;
            $url = url('/');

            $clientReservation = Reservation::where('user_id' , $user_id)->get();
            $trainings = Training::where('day' , $date)->orderBy('start')->get();


            if($trainings->count() == 0){
                $salida = ' <div class="empty-data">
                                <h3>No hay entrenos disponibles</h3>
                            </div>';
            }else{

                foreach($trainings as $training){
                    if(auth()->user()->hasRole(['admin', 'trainer'])){
                        $botonAdmin = ' <hr class="spacer-training">
                                        <div class="admin-container">
                                            <a class="mini-button button-cancel" id="open-modal" onClick="openModal('.$training->id.')">Apuntar a un atleta</a>
                                            <input type="hidden" value="'.$training->id.'" id="trainingId">
                                        <!--     <a href="#" class="mini-button button-cancel" style="margin-bottom: 0px">Modificar entreno</a> -->
                                        </div>';
                    }else{
                        $botonAdmin = '';
                    }

                    $isReserved = $this->isReserved($clientReservation , $trainings ,  $training->id);
                    $statusSub = $this->canReservation($user_id);
                    $statusSub = true;
                    $detailsUrl = route('trainings.show', $training->id);
                    if($isReserved){
                        $botones = '<button type="submit" class="button button-primary text-bold">Cancelar Reserva</button>
                                    <a href="'.$detailsUrl.'"class="button button-primary text-bold" style="margin-bottom: 0px">Detalles</a>';
                        $badge = '<span class="badge-custom badge-green">CLASE RESERVADA</span>';
                        $link = route('reservations.destroy', $training->id);
                        $method =  '<input type="hidden" name="_method" value="DELETE">';
                    }else{
                        if($statusSub){
                            $botones = '<button type="submit" class="button button-primary text-bold">Reservar</button>
                                        <a href="'.$detailsUrl.'" class="button button-primary text-bold" style="margin-bottom: 0px">Detalles</a>';                            
                        }else{
                            $botones = '<button type="submit" class="button button-primary button-disabled text-bold">Reservar</button>
                                        <a href="'.$detailsUrl.'" class="button button-primary text-bold" style="margin-bottom: 0px">Detalles</a>';                            
                        }

                        $badge = '';
                        $link = route('reservations.store');
                        $method = '';
                    }

                     $isFull = $this->isFull($training->capacity ,  $training->enroll);
                     if($isFull){
                            $badgeFull = '<span class="badge-custom badge-red">CLASE COMPLETA</span>';
                            $classSpan = 'text-red';
                            if(!$isReserved)
                            $botones = '<button type="submit" class="button button-primary button-disabled text-bold">Reservar</button>
                                        <a href="'.$detailsUrl.'" class="button button-primary text-bold" style="margin-bottom: 0px">Detalles</a>';
                     }else{
                            $badgeFull = '';
                            $classSpan = '';
                     }

                    $salida.='<form action="'.$link.'" method="POST" id="form'.$training->id.'">
                                    '.csrf_field().'
                                    '.$method.'
                                    <input type="hidden" value="'.$training->id.'" name="trainingId" class="fechas">
                                    <input type="hidden" value="'.$training->day->format('Y-m-d').'" name="currentDay">
                                    <div class="details-training-container animate fadeInDown delay-anim" style="--time: '.$time.'s;">
                                        <div class="wrapper-training">
                                            <div class="details-training">
                                                <span class="text-color-primary text-bold">'.$training->start->format('H:i').' - '.$training->end->format('H:i').'</span>
                                                <div class="status-training">
                                                    <span class="text-bold text-grey">Crossfit</span>
                                                    '.$badgeFull.'
                                                    '.$badge.'              
                                                </div>
                                                <span class="text-bold text-capacity">Plazas ocupadas: <span class="'.$classSpan.'">'.$training->enroll.'/'.$training->capacity.'</span></span>
                                            </div>
                                            <div class="button-training">
                                                '.$botones.'
                                            </div>
                                        </form>
                                            '.$botonAdmin.'
                                        </div>
                                    </div>';

                    $time = $time + 0.5;
                }

                $salida.= '<script src="'.$url.'/js/modal.js"></script>
                            <img onerror="func(this)" src="" style="display:none">';

            }

            return $salida;

        } //Fin if ajax

    } //Fin funcion displayTrainings    

    public function isReserved($clientReservation , $trainings , $idTraining){

        foreach($trainings as $training){
            foreach($clientReservation as $reservation){
                if($training->id == $reservation->training_id && $training->id == $idTraining){
                    return true;
                }
            }
        }

        return false;

    }

    public function isFull( $capacity , $enroll){
        if($capacity == $enroll){
            return true;
        }

        return false;
    }

    public function canReservation($user_id){
        $user_sub = User::findOrFail($user_id)->first();
        if($user_sub->payment_status == 1){
            return true;
        }else{
            return false;
        }

    }

    public function listTrainings(){

        $currentDate = Carbon::now();
        $reservation = Reservation::where('user_id' , auth()->user()->id)->get(['training_id']);
        $trainings = Training::whereIn('id' , $reservation)->whereDate('day' , '>=' ,  $currentDate)->paginate(5);

        return view('trainings.list' , compact('trainings'));
    }

}


