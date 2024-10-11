<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\service\ResponseSender as Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class LoginController extends Controller
{
    public function logout()
    {
        $user = auth('sanctum')->user();
        if ($user->tokens()->where('id', $user->currentAccessToken()->id)->delete()) {
                $user_table = User::find($user->id);
                $user_table->save();
                $res = Response::send('true', $data = [], $message = __('auth.logout_success'), $code = 200);
        } else {
            $res = Response::send('true', $data = [], $message = __('auth.logout_error'), $code = 400);
        }
        return $res;
    } 

    public function adminLogin(Request $request)
    {
        $logger = Log::channel('admin');

        $fields = $request->input();
        $validator = Validator::make($request->all(), 
        [
            'email' => 'required|email',
            'password' => 'required|min:6|max:16',
                
        ],
        [
            'email.email' => __('error.email_valid'),
        ]
        );
        try {
            $validatedData = $validator->validate();

            $email = $fields['email'];
            $user = new User;
            $check = User::where('email', $email)->where('role_id',1)->first();
            if ($check) {
                if (Hash::check($fields['password'], $check->password)) {
                    if ($check->status == '1') {
                        
                        $details = $check;
                        $user_details = $details;

                        /* Create Token */
                        $token = $details->createToken('my-app-token')->plainTextToken;
                        $user_details->token = $token;
                        $details = array(
                            'details' => $details,
                        );

                        $res = Response::send('true', $data = $details, $message = __('success.login_success'), $code = 200);

                    } else {
                        $res = Response::send('false', $data = [], $message = __('error.login_blocked_error'), $code = 400);
                    }
                } else {
                    $res = Response::send('false', $data = [], $message = ['password' => [__('error.login_password_error')]], $code = 422);
                }
            } else {
                $res = Response::send('false', $data = [], $message = ['email' => [__('error.login_email_error')]], $code = 422);
            }
            return $res;
        } catch (\Exception | \PDOException | \Throwable $e) {
                        
            if( $validator->errors()->first() ) {

                $logger->error( 'Invalid field items: ' . $e->validator->errors()->first());
                $logger->error($fields);

                $errors = collect($validator->errors());
                $res = Response::send('false', $data = [], $message = $errors, $code = 422);
                return $res;
                    // return response(['success' => false, 'message' => $e->validator->errors()->first()]);

            }  else {

                $logger->error( 'Login failed: ' . $e->getMessage());
                $logger->error($fields);

                if($logger)
                {
                    $res = Response::send('true',
                            [],
                            $message = __('Failed to login'),
                            $code = 200);
                }
                return $res;
            }
        }      
    }

}
