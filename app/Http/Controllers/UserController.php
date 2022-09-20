<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\getSchedulerApiData;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
        $this->getMiddleware();
    }
    
    /**
     * List
     * @group User
     */
    public function index(Request $request)
    {
        $users = User::with(['creater'])->pimp()->paginate();
        $message = "All records";
        UserResource::collection($users);
        return $this->sendResponse(compact('users'), $message);
    }

    /**
     * Add
     * @group User
     */
    public function store(Request $request)
    {
        $user = User::createUpdate(New User, $request);
        $message = "User added successfully";
        $user = new UserResource($user);

        /*
        * Send email on user registration by admin with scheduler
        */
        $arrTemplateConstant = [];
        /**  Variable need to be change in template*/
        $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
        $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
        $arrTemplateConstant['#USER-NAME#'] = $user->name;
        $arrTemplateConstant['#USER-EMAIL#'] = $user->email;
        $arrTemplateConstant['#USER-PASSWORD#'] = $user->password;
        if($user->client_id == 2) {
            $arrTemplateConstant['#LOGIN-LINK#'] = "https://www.soultatva.com.au";
        } else {
            $arrTemplateConstant['#LOGIN-LINK#'] = "https://www.soultatva.com";
        }

        $request->request->add(['client_id' =>  $user->client_id]);
        $request->request->add(['project_id' =>  1]);
        $request->request->add(['status' =>  'Send']);
        $request->request->add(['from_email' =>  'admin@soultatva.com']);
        $request->request->add(['to_email' =>  $user->email]);
        $request->request->add(['subject' =>  'User Registration By Admin']);

        if($user->client_id == 2) {
            $request->request->add(['email_template_id' =>  26]);
            $request->request->add(['template' =>  '26_user_registration_admin']);
        } else {
            $request->request->add(['email_template_id' =>  3]);
            $request->request->add(['template' =>  '03_user_registration_admin']);
        }  

        $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);
        getSchedulerApiData($request);

        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Show
     * @group User
     */
    public function show(User $user, Request $request)
    {
        $message = "Users listed succesfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Update
     * @group User
     */
    public function update(EditRequest $request, User $user)
    {
        $user = User::createUpdate($user, $request);
        $message = "User updated successfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Delete
     * @group User
     */
    public function destroy(User $user, Request $request)
    {
        $user->delete();
        $message = "User deleted successfully!!";
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);
    }

    /**
     * Change client api
     */
    public function changeclient(User $user ,Request $request)
    {
        $user = Auth::user();
        $message = "Client updated successfully!!";
        $user->client_id = $request->client_id;
        $user->save();
        $user = new UserResource($user);
        return $this->sendResponse(compact('user'),$message);   
    }

    public function getUserList(Request $request)
    {
        $users = User::with('creater')->pimp()->get();
        $message = "All records";
        UserResource::collection($users);
        return $this->sendResponse(compact('users'),$message);
    }

}
