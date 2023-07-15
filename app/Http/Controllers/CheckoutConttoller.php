<?php

namespace App\Http\Controllers;

use App\Enums\ConstantEnum;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use Throwable;

class CheckoutConttoller extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('front.orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        $coupon = Session::get('coupon');
//
//        return view('front.checkout', [
//            'coupon' => $coupon,
//            'discount' => $coupon['discount'] ?? 0,
//            'user' => Auth::user(),
//            'order' => new Order(),
//        ]);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = new Order();

            //createOrder is a method in the Order model

            $order= $order->createOrder($request, $this->getFormData($request));


            DB::commit();

//            event(new OrderCreated($chec));

            return redirect()->route('orders.paymentIntent.create', $order->id);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        Order::destroy($id);

        return response()->json(['message' => 'Order deleted!'], 200);
    }


    protected function getFormData(Request $request)
    {
        $formData = [];

        if ($request->type == ConstantEnum::SOCIAL_MEDIA) {
            $formData[] = [
                'type' => ConstantEnum::SOCIAL_MEDIA,
                'org_name' => $request->org_name,
                'general_def' => $request->general_def,
                'competitors' => $request->competitors,
                'contacts' => $request->contacts,
                'geographical_area' => $request->geographical_area,
                'design_content' => $request->design_content,
                'notes' => $request->notes,
                'images' => $this->storeImagesByType(ConstantEnum::SOCIAL_MEDIA, $request)
            ];
        }


        if ($request->type == ConstantEnum::SHEAARAT) {
            $formData[] = [
                'type' => ConstantEnum::SHEAARAT,
                'brand_name' => $request->brand_name,
                'describe_reason_choosing_name' => $request->describe_reason_choosing_name,
                'competitors' => $request->competitors,
                'explain_idea_project' => $request->explain_idea_project,
                'summarize' => $request->summarize,
                'distinguish_you_from_them' => $request->distinguish_you_from_them,
                'target_group' => $request->target_group,
                'is_picture_distinguish_you_from_them' => $request->is_picture_distinguish_you_from_them,
                'lang' => $request->lang,
                'images' => $this->storeImagesByType(ConstantEnum::SHEAARAT, $request)
            ];
        }

        return $formData;
    }


    public function storeImagesByType($type, $request)
    {
        $images = [];
        if ($type === ConstantEnum::SOCIAL_MEDIA) {
            if ($request->images) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('social', [
                        'disk' => 'public',
                    ]);
                    $images[] = $path;
                }
            }
        } elseif ($type === ConstantEnum::SHEAARAT) {
            if ($request->images) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('shaaarat', [
                        'disk' => 'public',
                    ]);
                    $images[] = $path;
                }
            }
        }

        return $images;
    }


}
