<?php

use Illuminate\Http\Request;
use App\User;
use App\ApplicantAdditionalData;
use App\BusinessJobRequirement;
use App\BusinessJob;
use App\ApplicantRequirement;
use App\BusinessAdditionalData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@meData');
    Route::post('message', 'AuthController@message');
    Route::post('get_message', 'AuthController@getMessage');

});

Route::get('users', function () {
    return response(User::all(),200);
});

Route::post('users', function(Request $request) {
    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'type' => $request->type
    ]);
    if($request->type == 1){
        $user_info = ApplicantAdditionalData::create([
            'user_id' => $user->id
        ]);
    } else {
        $user_info = BusinessAdditionalData::create([
            'user_id' => $user->id
        ]);
    }
            
    return $user;
});


Route::get('jobs', function(Request $request){
    
    $query = "SELECT * FROM business_jobs AS bj
    LEFT JOIN business_additional_datas AS bad 
        ON bj.business_id = bad.user_id
        ORDER BY RAND()";

    $requirements = DB::select($query, []);
    foreach ($requirements as $index=>$requirement){
        $jobRequirements = BusinessJobRequirement::select('*')->where('job_id', $requirement->id)->get()->toArray();
        $requirements[$index]->jobRequirements = $jobRequirements;
    };
    return $requirements;
});

Route::get('users/{id}', function(Request $request, $id) {
    $userInfo = User::find($id)->toArray();
    $type = $userInfo['type'];

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
});

Route::get('/jobs/{id}', function(Request $request, $id) {
    $jobInfo = BusinessJob::find($id)->toArray();
    $jobRequirements = BusinessJobRequirement::select('*')->where('job_id', $id)->get()->toArray();

    $response = [
        'job_info' => $jobInfo,
        'job_requirements' => $jobRequirements
    ];

    return response()->json($response);
});

Route::get('skills', function(Request $request){
    
    $query = "SELECT DISTINCT requirement FROM business_job_requirements";

    $requirements = DB::select($query, []);
    
    return $requirements;
});

Route::post('skills/applicant', function(Request $request){
    $applicant = ApplicantRequirement::create([
        'skill' => $request->skillName,
        'years_exp' => $request->skillYears,
        'applicant_id' => $request->id
    ]);

    return [
        'message' => 'success'
    ];
});

Route::post('applicant', function(Request $request){
    
    $applicant = ApplicantAdditionalData::updateOrCreate(
        ['user_id' => $request->id], [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'date_of_birth' => $request->dateOfBirth,
            'user_id' => $request->id,
            'number' => $request->number,
            'education_attained'  => $request->educationAttained,
            'education'  => $request->education,
            'email'  => $request->email,
            'extra_skills' => $request->extraSkills
        ]);
        
    return response()->json($applicant);
});


Route::post('applicant/delete', function(Request $request){
    ApplicantRequirement::destroy($request->id);

    return response()->json([
        'message' => 'success'
    ]);
});

Route::post('business/job', function(Request $request){
    $job = BusinessJob::create([
        'business_id' => $request->businessId,
        'job_title' => $request->jobTitle,
        'description' => $request->description
    ]);

    $jobId = $job->id;

    foreach($request->requirements as $requirement){
        $req = BusinessJobRequirement::create([
            'requirement' => $requirement['skill'],
            'years_exp' => $requirement['years_exp'],
            'job_id' => $jobId
        ]);
    }

    return response()->json([
        'message' => 'success'
    ]);
});

Route::post('business/update', function(Request $request){
    
    $business = BusinessAdditionalData::updateOrCreate(
        ['user_id' => $request->id], [
            'business_name' => $request->businessName,
            'description' => $request->description,
            'user_id' => $request->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude

        ]);
        
    return response()->json($business);
});