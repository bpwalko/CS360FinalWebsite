<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\vendor;
use Hash;
  
class VendController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('vend.loginVend');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function vendorRegistration()
    {
        return view('vend.vendorRegistration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLoginVend(Request $request)
    {
        $request->validate([
            'vendName' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('vendName', 'username', 'password');
        $request->session()->put('username', $credentials['username']);
        $request->session()->put('vendName', $credentials['vendName']);
        
        if (Auth::guard('vendor')->attempt($credentials)) {
            return redirect()->intended('vendorHub')
                        ->withSuccess('You have Successfully logged in');
        }
  
        return redirect("registration")->withSuccess('Your credentials were incorrect');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postVendorRegistration(Request $request)
    {  
        $request->validate([
            'vendName' => 'required',
	        'address' => 'required',
            'username' => 'required',
	        'vendType' => 'required',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        $request->session()->put('username', $request->username);
        $request->session()->put('vendName', $request->vendName);

        return redirect("vendorHub")->withSuccess('You have Successfully logged in!');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('vendorHub');
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
      return vendor::create([

        'vendName' => $data['vendName'],
        'address' => $data['address'],
        'username' => $data['username'],
        'vendType' => $data['vendType'],
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
}