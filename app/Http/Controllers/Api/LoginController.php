<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\UserRoleResource;
use App\Models\Client;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;
use function App\Helpers\getSchedulerApiData;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            $success['token'] =  $user->createToken(config('app.name'))->accessToken;

            // Addtinational information with the login user
            $userRole = $user->userRole->load(['role','user','creater']);

            $success['login_user_detail'] = new UserRoleResource($userRole);

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|digits:10|numeric|unique:users,mobile_no',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $url = URL('/');
        
        $client_id = Client::where('name', $url)->value('id');

        $input['client_id'] = $client_id;

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('app.name')->accessToken;
        
        /*
         * add customer role
         */
        $newUserRole = new UserRole();
        $newUserRole->user_id = $user->id;
        $newUserRole->role_id = '3';
        $newUserRole->save();
        /*
         * Addtinational information with the register user  
         */ 
        $userRole = $user->userRole->load(['role','user','creater']);
        $success['login_user_detail'] = new UserRoleResource($userRole);
        
        /*
         * Send email on register with scheduler
         */
        $arrTemplateConstant = [];
        /**  Variable need to be change in template*/
        $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
        $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
        $arrTemplateConstant['#USER-NAME#'] = $user->name;
           
        $request->request->add(['client_id' =>  $input['client_id']]);
        if($user->client_id == 2){
            $request->request->add(['email_template_id' =>  34]);
            $request->request->add(['template' =>  '34_user_registration_front']);
        } else{
            $request->request->add(['email_template_id' =>  11]);
            $request->request->add(['template' =>  '11_user_registration_front']);
        }
        $request->request->add(['project_id' =>  1]);
        $request->request->add(['from_email' =>  'admin@soultatva.com']);
        $request->request->add(['to_email' =>  $user->email]);
        $request->request->add(['subject' =>  'Registration']);
        $request->request->add(['status' =>  'Send']);
        $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);

        getSchedulerApiData($request);

        return $this->sendResponse($success, 'User register successfully.');
    }
}
