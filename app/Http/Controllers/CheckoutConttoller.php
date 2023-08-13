<?php

namespace App\Http\Controllers;

use App\Enums\ConstantEnum;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use Throwable;

class CheckoutConttoller extends Controller
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }


    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        DB::beginTransaction();
//
//        try {

        $order = new Order();

        //createOrder is a method in the Order model
        $data = $this->getFormData($request);
        $order = $order->createOrder($request, $data);

//            DB::commit();
//            $formData = json_decode($order->form_data);

        if (_get($data, 'direct_pay') == 0)
            return redirect()->route('orders');

        return redirect()->route('orders.paymentIntent.create', $order->id);
//        } catch (Throwable $e) {
//            DB::rollBack();
//            throw $e;
//        }
    }

    public function delete($id)
    {
        Order::destroy($id);

        return response()->json(['message' => 'Order deleted!'], 200);
    }


    protected function getFormData(Request $request)
    {
        $data = $request->all();
        $data['image'] = $this->storeImagesByType($request->type, $request);
        $data['direct_pay'] = $request->type == ConstantEnum::MOSHN ? 0 : 1;
        return $data;

//        $formData = [];
//        if ($request->type == ConstantEnum::SOCIAL_MEDIA) {
//            $formData[] = [
//                'type' => ConstantEnum::SOCIAL_MEDIA,
//                'org_name' => $request->org_name,
//                'general_def' => $request->general_def,
//                'competitors' => $request->competitors,
//                'contacts' => $request->contacts,
//                'geographical_area' => $request->geographical_area,
//                'design_content' => $request->design_content,
//                'notes' => $request->notes,
//                'images' => $this->storeImagesByType(ConstantEnum::SOCIAL_MEDIA, $request),
//                'direct_pay' => 1,
//
//            ];
//        }
//
//
//        if ($request->type == ConstantEnum::SHEAARAT) {
//            $formData[] = [
//                'type' => ConstantEnum::SHEAARAT,
//                'brand_name' => $request->brand_name,
//                'describe_reason_choosing_name' => $request->describe_reason_choosing_name,
//                'competitors' => $request->competitors,
//                'explain_idea_project' => $request->explain_idea_project,
//                'summarize' => $request->summarize,
//                'distinguish_you_from_them' => $request->distinguish_you_from_them,
//                'target_group' => $request->target_group,
//                'is_picture_distinguish_you_from_them' => $request->is_picture_distinguish_you_from_them,
//                'lang' => $request->lang,
//                'images' => $this->storeImagesByType(ConstantEnum::SHEAARAT, $request),
//                'direct_pay' => 1,
//            ];
//        }
//
//
//        if ($request->type == ConstantEnum::MOSHN) {
//            $formData[] = [
//                "type" => $request->type,
//                "total" => $request->total,
//                "org_name" => $request->org_name,
//                "general_def" => $request->general_def,
//                "size" => $request->size,
//                "video_type" => $request->video_type,
//                "whats_up" => $request->whats_up,
//                "contacts" => $request->contacts,
//                "geographical_area" => $request->geographical_area,
//                "competitors" => $request->competitors,
//                "notes" => $request->notes,
//                "images" => $this->storeImagesByType(ConstantEnum::MOSHN, $request),
//                'direct_pay' => 0,
//            ];
//        }
//        return $formData;
    }


    public function storeImagesByType($type, $request)
    {
        $images = [];
        if ($request->images)
            foreach ($request->file('images') as $image)
                $images[] = $this->imageRepository->upload($image);
        return $images;
//        if ($type === ConstantEnum::SOCIAL_MEDIA) {
//            if ($request->images) {
//                foreach ($request->file('images') as $image) {
//                    $path = $image->store('social', [
//                        'disk' => 'public',
//                    ]);
//                    $images[] = $path;
//                }
//            }
//        } elseif ($type === ConstantEnum::SHEAARAT) {
//            if ($request->images) {
//                foreach ($request->file('images') as $image) {
//                    $path = $image->store('shaaarat', [
//                        'disk' => 'public',
//                    ]);
//                    $images[] = $path;
//                }
//            }
//        }

        return $images;
    }


}
