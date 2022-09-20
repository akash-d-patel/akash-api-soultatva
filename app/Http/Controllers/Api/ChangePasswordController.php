<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Url;

use function App\Helpers\getSchedulerApiData;

class ChangePasswordController extends BaseController
{
    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $user = Auth::user();
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());

                    /*
                    * Send email on change password with scheduler
                    */
                    $arrTemplateConstant = [];
                    /**  Variable need to be change in template*/
                    $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
                    $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
                    $arrTemplateConstant['#USER-NAME#'] = Auth::user()->name;
                    $arrTemplateConstant['#USER-EMAIL#'] = Auth::user()->email;
                    $arrTemplateConstant['#USER-PASSWORD#'] = Auth::user()->password;
                    if($user->client_id == 2) {
                        $arrTemplateConstant['#LOGIN-LINK#'] = 'https://www.soultatva.com.au';
                    } else {
                        $arrTemplateConstant['#LOGIN-LINK#'] = 'https://www.soultatva.com';
                    }
                    
                    $request->request->add(['client_id' =>  Auth::user()->client_id]);
                    $request->request->add(['project_id' =>  1]);
                    $request->request->add(['from_email' =>  'admin@soultatva.com']);
                    $request->request->add(['to_email' =>  Auth::user()->email]);
                    $request->request->add(['subject' =>  'Change Password']);
                    $request->request->add(['status' =>  'Send']);
                    if($user->client_id == 2) {
                        $request->request->add(['email_template_id' =>  27]);
                        $request->request->add(['template' =>  '27_password_change']);
                    } else {
                        $request->request->add(['email_template_id' =>  4]);
                        $request->request->add(['template' =>  '04_password_change']);
                    }
                    
                    $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);

                    getSchedulerApiData($request);

                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return Response::json($arr);
    }
}
