<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckinController extends \App\Http\Controllers\Controller {
    public function checkin(Request $request){
        $checkin = new \App\Checkin;
        $checkin->lat = $request->input('lat');
        $checkin->long = $request->input('long');
        if($request->input('check_type')=='love'){
            $checkin->check_type = 'love';
            $checkin->save();
            return ['success'=>true];
        }
        
        if($request->input('check_type')=='message'){
            $checkin->check_type = 'message';
            $checkin->data = $request->input('message');
            $checkin->save();
            return ['success'=>true];
        }
        
        if($request->input('check_type')=='photo'){
            $checkin->check_type = 'photo';
            //$checkin->data = $request->input('message');
            $checkin->save();
            return ['success'=>true];
        }
        
        return ['nothing'];
    }
    
    public function nearby(Request $request){
        $checkins = \App\Checkin::where('lat','>',$request->input('lat')-0.001)
                ->where('lat','<',$request->input('lat')+0.001)
                ->get();
        return $checkins;
    }
}
