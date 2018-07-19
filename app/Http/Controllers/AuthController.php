<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use JWTAuth;
use App\User;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','all','delete','getUser','updateUser']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    //register a user

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return  response()->json($validator->errors());
        }

        $userCreated = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
       
        $credentials = request(['name','email', 'password']);
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        if (! $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['user'=> $userCreated],200);


    }

    public function all() {
        $users = User::all();
        return response()->json(['users'=> $users],200);
    }
    public function delete($id) {
        $user = User::whereId($id)->first();
        $user->delete();
        return  response()->json(['user'=> $user],200);
    }

    public function getUser($id) {
        return response()->json(['user' => User::whereId($id)->first()],200);
    } 

    public function updateUser(Request $request, $id)  {
        $user = User::whereId($id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json(['user' =>  User::whereId($id)->first()],200);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'user'=>$this->guard()->user(),
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard() {
        return Auth::Guard('api');
    }
}