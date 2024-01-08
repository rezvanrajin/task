<?php

namespace App\Http\Controllers;

use Stripe;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe as StripeStripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class IndexController extends Controller
{
    public function plan()
    {
        return view('plan.plan');
    }
    public function basicPay()
    {
        return view('plan.basic_pay');

    }
    public function proPlan()
    {
        return view('plan.pro_pay');

    }
    public function businessPay()
    {
        return view('plan.business_pay');

    }
    public function stripePayment(Request $request)
    {   

       $user_ip = $_SERVER['REMOTE_ADDR'];
       $orders = Order::create([
        'user_ip' => $user_ip,
        'name' => $request->name,
        'service' => $request->service,
        'email' => $request->email,
        'phone' => $request->phone,
        'country' => $request->country,
        'city' => $request->city,
        'company_name' => $request->company_name,
        'website'=> $request->website,
        
    ]);

        $stripe = new \Stripe\StripeClient("sk_test_51OVv97F9fRlms8DwN6ZAknHmoSQfWvDpVl7nmw1iluPEFErJSiUzyZNeyyntnuz226RRTanDi6xVq8T2vHGeCcDU00kyrpJckm");

     $plan = [];
        $order = Order::where('user_ip',$user_ip)->get();
        foreach($order as $key => $item)
        {
            $plan[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' =>[
                        'name' => $request->plan,
                    ],
                    'unit_amount' =>100 * $request->price ,
                ],
                'quantity' =>1,
            ];
        }

        $response = $stripe->checkout->sessions->create([


            'customer_email' => $request->email,

            'line_items' => [
                $plan
               ],

            'mode' => 'payment',
            'allow_promotion_codes' => true,
            'success_url' => route('stripe.paymentSuccess'),
        ]);
        return redirect()->away($response->url);
        
    }

    public function stripeSuccessPayment(Request $request)
    {
        

        return redirect()->route('user.plan')->with('success','Payment successful.');
    }

    public function login()
    {
        return view('admin.login');
    }
    public function AdminLoginPost(Request $request)
    {
        
        // dd($request->all());
        if(Auth::check()){
            return redirect('admin/dashboard');
        }else{
            if($request->isMethod('post')){
                $data = $request->input();
                 if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // dd("test");
                    return redirect()->route('admin.dashboard');
                }else{
                    //echo "failed"; die;
                    return redirect()->route('login')->with('flash_message_error','Invalid Username or Password');
                }
            }
        }

        return view("admin.login");
    }
    public function dashboard()
   {
    return view('admin.file.dashboard');

   }
}
