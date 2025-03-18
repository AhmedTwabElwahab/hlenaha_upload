<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\profileRequest;
use App\Http\Requests\Api\registerRequest;
use App\Http\Requests\api\UserRestPasswordRequest;
use App\Models\Banners;
use App\Models\trip;
use App\Models\User;
use App\Notifications\activeUserNotification;
use App\Notifications\SendNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\once;

class ProfileController extends BaseController
{
    public function index(): JsonResponse
    {
        $data = User::join('drivers', 'users.id', '=', 'drivers.user_id')
            ->select('users.*', 'drivers.*', 'drivers.id as driver_id','users.id as id')
            ->where('users.id', auth()->user()->id)->first();

        $banners = Banners::all();
        $trips = Trip::where('driver_id',$data->driver_id)->get()->toArray();

        return $this->sendResponse([
            'user_info'      => $data->toArray(),
            'trips'          => $trips,
            'trips_Revenues' => 0,
            'banners'        => $banners,
        ], 'Users retrieved successfully.');
    }


    public function update(profileRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $User = auth()->user();
            $send_Email = false;
            if ($request->input('email') !== $User->email)
            {
                $send_Email = true;
                $User->email_verified_at = null;
            }
            $User->name               = $request->input('name') ?? $User->name;
            $User->email              = $request->input('email') ?? $User->email;
            $User->gender             = $request->input('gender');
            $User->phone              = $request->input('phone') ?? $User->phone;
            $User->birth_date         = $request->input('birth_date');
            $User->updated_at         = Carbon::now();

            if (!$User->update())
            {
                throw new Exception('update_error');
            }
            DB::commit();

            $send_Email ? $User->sendEmailVerificationNotification() : '';
            return $this->sendResponse($User, 'User updated successfully.');
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            return $this->failed($message);
        }
    }

    public function forgotPassword(UserRestPasswordRequest $request)
    {
        DB::beginTransaction();
        try
        {
            // Check if the current password matches
            if (!Hash::check($request->current_password, Auth::user()->password))
            {
                throw new Exception('current_password_error');
            }

            // Update the password
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            return $this->sendResponse($user,__('global.update_success'));
        } catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            return $this->failed($message);
        }

    }

}
