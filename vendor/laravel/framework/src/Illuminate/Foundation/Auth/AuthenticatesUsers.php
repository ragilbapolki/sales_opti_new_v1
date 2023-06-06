<?php

namespace Illuminate\Foundation\Auth;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\DeviceController;
use App\Log;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $koneksi = mysqli_connect ('127.0.0.1','root','cdi456b6f'); // sory hardcore :P
        $copy_items = " INSERT INTO cdi_sales2.items (id,nama,harga_jawa,harga_luar_jawa,harga_batam,suplier,hidden)
         SELECT a.kode_cabang,a.nama_cabang,a.harga_jawa,a.harga_luarjawa,a.harga_batam,a.produsen,IF( ndelik = 'N' , 0, 1 ) AS ndelik
         FROM cobradental_master_pos.databarang a
         WHERE a.kode_cabang <> '' AND a.kode_cabang IS NOT NULL 
         ON DUPLICATE KEY UPDATE nama=a.nama_cabang,harga_jawa=a.harga_jawa,harga_luar_jawa=a.harga_luarjawa,harga_batam=a.harga_batam,suplier=a.produsen,hidden=IF(ndelik = 'N' , 0, 1 )";
        $result = $koneksi->query($copy_items);

        $kuericron = "INSERT INTO cdi_kranggan.cronjobs (file,execute,keterangan,status,created_at)
        VALUES ('Login Sales','cdiSALES2','CMP17(databarang) ke cdiSALES2(item)','Sukses',NOW())";
        $result3=$koneksi  -> query($kuericron);

        $iduser = Auth::user()->id;
        $skac = new DeviceController;
        $device= $skac -> device();
        $client_ip= $skac -> get_client_ip();
        $log = new Log;
        $log->user_id = $iduser;
        $log->kode_cabang = Auth::user()->kode_cabang;
        $log->aktivitas = 'login';
        $log->device = $device;
        $log->ip = $client_ip;
        $log->save();
        Session::put('device', $device);
        Session::put('client_ip', $client_ip);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $platformcdi= Session::get('platformcdi');
        $this->guard()->logout();

        $request->session()->invalidate();
        
        if (!empty($platformcdi)) {
            $device= $platformcdi;
        } else {
            $device= 'cdi';
        }
        return redirect()->route('home', ['id' => $device]);
        // return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
