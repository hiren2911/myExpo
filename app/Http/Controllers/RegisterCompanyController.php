<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterCompanyController extends Controller
{
    /**
     * Register compnay as user and return user object
     */

    public function store(Request $request)
    {

        $data = $request->json()->all();

        $validation = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string',
            'logo' => 'required|string',
            'document' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validation->fails()) {
            $error = $validation->errors();
            return response()->json($error, 500, [], JSON_NUMERIC_CHECK);
        } else {
           
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'address' => $data['address'],
                'logo' => $data['logo'],
                'document' => $data['document'],
                'password' => bcrypt($data['password']),
            ]);

            return response()->json($user, 200, [], JSON_NUMERIC_CHECK);
        }


    }

    /**
     * Function uploads file and returns path of file
     */
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file_content')) {
            $path = \basename($request->file_content->store('public'));

            if ($path) {
                return response()->json(['path' => $path], 200);
            }
            else {
                return response()->json(['path' => ''], 500);
            }
        }
    }


    /**
     *   Function binds compnay to stand and marks the stand at booked.
     **/
    public function bindStand(Request $request)
    {
        $data = $request->json()->all();
        $stand = \App\Stand::where('id', $data['stand_id'])->first();
        $stand->user_id = $data['user_id'];
        $stand->status = 1;    // update book flag
        $stand->save();
        return response()->json(['succus' => true], 200);
    }

    /**
     *   Function returns booked stands for user with related event details
     *
     */
    public function getBookedStand($user_id)
    {
        $user = User::where('id', $user_id)->with('stands.event')->first();
        
        /*foreach($user->stands as $stand) {
            $stand->event = $stand->event;
        }*/

        return response()->json($user, 200, [], JSON_NUMERIC_CHECK);
    }
}
