<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home() {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza','category', 'cart'));
    }

    // filter
    public function filter($categoryId) {
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza','category', 'cart'));
    }

    // change password page
    public function changePasswordPage() {
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;   // hash value

        if(Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return back()->with(['changeSuccess' => 'Password Changed.']);
        };

        return back()->with(['notMatch' => "Old Password don't match. Try Again!"]);
    }

    // account change page
    public function accountChangePage() {
        return view('user.profile.account');
    }

    // account change
    public function accountChange($id, Request $request) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return back()->with(['changeSuccess' => 'Account Updated...']);
    }

    // pizza details
    public function pizzaDetails($pizzaId) {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::take(6)->inRandomOrder()->get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    // cart list
    public function cartList() {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
                    ->leftJoin('products','products.id', 'carts.product_id')
                    ->where('carts.user_id', Auth::user()->id)
                    ->get();

        $totalPrice = 0;
        foreach($cartList as  $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

    // history
    public function history() {
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.main.history', compact('order'));
    }

    // user list page
    public function userList() {
        $users = User::where('role', 'user')
                ->when(request('key'), function ($query) {
                    $query->where('users.name', 'like', '%' . request('key') . '%')
                        ->orWhere('users.email', 'like', '%' . request('key') . '%')
                        ->orWhere('users.phone', 'like', '%' . request('key') . '%');
                })
                ->paginate(6);
        $users->appends(request()->all());
        return view('admin.user.list', compact('users'));
    }

    //change user role
    public function userChangeRole(Request $request) {
        User::where('id', $request->userId)->update([
            'role'=> $request->role
        ]);
    }

    // delete user
    public function userDelete($id) {
        User::where('id', $id)->delete();
        return redirect()->route('admin#userList')->with(['deleteSuccess' => 'User Account Deleted Successfully!']);
    }

    // request user data
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    // account validation check
    private function accountValidationCheck ($request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
        ])->validate();
    }

    // password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:20',
            'newPassword' => 'required|min:6|max:20',
            'confirmPassword' => 'required|min:6|max:20|same:newPassword',
        ])->validate();
    }
}
