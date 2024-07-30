<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\service\ResponseSender as Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function users(Request $request)
    {
        $fields     = $request->input();
        $validator  = Validator::make($request->all(), 
        [
            'limit' => 'required|numeric',
            'keyword' => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = collect($validator->errors());
            $res    = Response::send('false', $data = [], $message = $errors, $code = 422);
        }
        else 
        {

            $users = User::select('users.*', 'department.name as department_name', 'designation.name as designation_name')
                        ->join('department', 'department.id', '=', 'users.department_id')
                        ->join('designation', 'designation.id', '=', 'users.designation_id')
                        ->orderBy('users.id', 'asc');

            if($fields['keyword'])
            {
                $users->where(function ($query) use ($request) {
                    $query->where('users.name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('department.name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('designation.name', 'LIKE', '%' . $request->keyword . '%');
                });
            }

            $users = $users->paginate($fields['limit']);

            $data = array(
                'users' => $users,
            );

            $res    = Response::send('true',
                        $data,
                        $message = 'Success',
                        $code = 200
                    );
        }
        return $res;

    }
}
