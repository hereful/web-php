<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheckinController extends \App\Http\Controllers\Controller {

    public function checkin(Request $request) {
        $checkin = new \App\Checkin;
        $checkin->lat = $request->input('lat');
        $checkin->long = $request->input('long');
        if ($request->input('check_type') == 'love') {
            $checkin->check_type = 'love';
            $checkin->save();
            return ['success' => true];
        }

        if ($request->input('check_type') == 'message') {
            $checkin->check_type = 'message';
            $checkin->data = $request->input('message');
            $checkin->save();
            return ['success' => true];
        }

        if ($request->input('check_type') == 'photo') {
            $checkin->check_type = 'photo';
            //$checkin->data = $request->input('message');
            $checkin->save();
            return ['success' => true];
        }

        return ['nothing'];
    }

    public function nearby(Request $request) {

        $checkins = \App\Checkin::
                where('lat', '>', $request->input('lat') - 0.001)
                ->where('lat', '<', $request->input('lat') + 0.001)
                ->where('long', '>', $request->input('long') - 0.001)
                ->where('long', '<', $request->input('long') + 0.001)
                ->get();
        return $checkins;
    }

    public function bot(Request $request) {

        $data = array("chat_id" => $request->input('message.chat.id'), "text" => "test");
        $data_string = json_encode($data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot443523368:AAGhBvh-3Hyk_w524uex9ERY0nZK4HTPat4/sendMessage");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
    }

}
