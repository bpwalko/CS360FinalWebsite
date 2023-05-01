<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
	        'lastname' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('firstname', 'lastname', 'password');
        $request->session()->put('firstname', $credentials['firstname']);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('update')
                        ->withSuccess('You have Successfully logged in');
        }
  
        return redirect("login")->withSuccess('Your credentials were incorrect');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'firstname' => 'required',
	    'lastname' => 'required',
            'email' => 'required|email|unique:users',
	    'phoneNum' => 'required',
            'password' => 'required|min:3',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        $request->session()->put('firstname', $request->firstname); 


        return redirect("update")->withSuccess('You have Successfully logged in!');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function userHub()
    {
        if(Auth::check()){
            return view('userHub');
        }
  
        return redirect("login")->withSuccess('Your credentials were incorrect');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'firstname' => $data['firstname'],
	'lastname' => $data['lastname'],
        'email' => $data['email'],
	'phoneNum' => $data['phoneNum'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function firstname()
    {
    	return 'firstname';
    }


}