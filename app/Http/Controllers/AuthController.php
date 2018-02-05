<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\ApplicantAdditionalData;
use App\BusinessAdditionalData;
use App\BusinessJob;
use App\BusinessJobRequirement;
use App\ApplicantRequirement;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function meData()
    {
        $id = auth()->user()->id;
        $type = auth()->user()->type;
        /**
         *  1 -> applicant, 2 -> business
         */

        if($type === 1){
            $userAdditional = ApplicantAdditionalData::find($id);
            $requirements =  ApplicantRequirement::select('*')->where('applicant_id', $id)->get();
        } else {
            $userAdditional = BusinessAdditionalData::find($id);
            $requirements = BusinessJob::select('*')->where('business_id', $id)->get()->toArray();
            foreach ($requirements as $index=>$requirement){
                $jobRequirements = BusinessJobRequirement::select('*')->where('job_id', $requirement['id'])->get()->toArray();
                $requirements[$index]['jobRequirements'] = $jobRequirements;
            };
        };
        $response = [
            'id' => $id,
            'type' => $type,
            'data' => $userAdditional ? $userAdditional->toArray() : [],
            'requirements' => $requirements ? $requirements : []
        ];
        return response()->json($response);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}