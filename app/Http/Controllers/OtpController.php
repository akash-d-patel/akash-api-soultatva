<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OtpResource;
use App\Models\Otp;
use Illuminate\Http\Request;

class OtpController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $otps = Otp::with('user')->pimp()->paginate();
        OtpResource::collection($otps);
        return $this->sendResponse(compact('otps'), "All Record");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Otp  $otp
     * @return \Illuminate\Http\Response
     */
    public function show(Otp $otp, Request $request)
    {
        $message = 'Otp listed successfully';
        $otp = new OtpResource($otp);
        return $this->sendResponse(compact('otp'), $message);
    }
}
