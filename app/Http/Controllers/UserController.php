<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->route('home');
        }


        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register(UserRegisterRequest $request): RedirectResponse
    {
        try {
            $data = $request->only(['username', 'email', 'password']);

            $input = $data;
            $input['password'] = bcrypt($data['password']);
            User::create($input);$data = $request->only(['username', 'email', 'password']);

            return redirect('/login')->with('status', 'Đăng ký thành công');;
        } catch (\Exception $th) {
            return redirect('/register');
        }
    }

    public function switchVoucher()
    {
        $vouchers = Voucher::where('expried_at', '>', Carbon::now())
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('user_vouchers')
                  ->where('user_id', Auth::user()->id);
        })
            ->get();

        $voucherUsers = Voucher::where('expried_at', '>', Carbon::now())
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                  ->from('user_vouchers')
                  ->where('user_id', Auth::user()->id);
            })
            ->get();


        return view('customers.switch_voucher', compact('vouchers', 'voucherUsers'));
    }

    public function swipVoucher($id)
    {
        $isCreate = DB::table('user_vouchers')->updateOrInsert([
            'voucher_id' => $id,
            'user_id' => Auth::user()->id
        ], [
            'is_use' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if ($isCreate) {
            return redirect()->route('switch-voucher');
        }
        return redirect()->route('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
