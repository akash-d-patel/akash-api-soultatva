<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function App\Helpers\getSchedulerApiData;

class ForgotPasswordController extends BaseController
{
    // forgot password
    public function forgotPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->get();

            if(count($user) > 0) {

                $token = Str::random(40);
                $frontUrl = $request->url;  
                $url = $frontUrl.'/reset-password?token=' .$token;

                $data['url'] = $url;
                $data['email'] = $request->email;
                $data['title'] = "Password Reset";
                $data['body'] = "Please click on below link to reset your password.";

                /*
                * Send email on reset password with scheduler
                */
                $arrTemplateConstant = [];
                /**  Variable need to be change in template*/
                $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
                $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
                $arrTemplateConstant['#URL#'] = $url;
                $arrTemplateConstant['#WEBSITE-URL#'] = $frontUrl;
                $arrTemplateConstant['#LOGIN-LINK#'] = "https://www.soultatva.com";

                $request->request->add(['project_id' =>  1]);
                $request->request->add(['status' =>  'Send']);
                $request->request->add(['from_email' =>  'admin@soultatva.com']);
                $request->request->add(['to_email' =>  $data['email']]);
                $request->request->add(['subject' =>  $data['title']]);
                $request->request->add(['email_template_id' =>  47]);
                $request->request->add(['template' =>  '47_password_reset']);
                $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);
        
                getSchedulerApiData($request);

                $datetime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $datetime
                    ]
                );
                return response()->json(['success'=>true, 'message'=>'Please check your mail to reset your password.']);
            } else {
                return $this->sendError('User not found!');
            }
            
        } catch (Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    // reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);
        $resetData = PasswordReset::where('token', $request->token)->first(); 
        if(!$resetData) {
            return $this->sendError('something went wrong..');  
        } else {
            $user = User::where('email', $resetData['email'])->first();
            $user->password = Hash::make($request->password);
            $user->save();
            PasswordReset::where('email', $user->email)->delete();
            return response()->json(['success'=>true, 'message'=>'Your password has been reset successfully..']);
        } 
    }
}
