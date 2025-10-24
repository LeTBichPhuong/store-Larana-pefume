<?php

namespace App\Http\Controllers;

use App\Helper\helpers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->get();

        $total = 0;
        foreach ($cartItems as $item) {
            $total += \App\Helper\helpers::parse($item->price) * $item->quantity;
        }

        return view('cart', compact('cartItems', 'total'));
    }

    // Thêm sản phẩm vào giỏ
    public function add($id)
    {
        $userId = Auth::id();
        $product = Product::findOrFail($id);

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'quantity' => 1,
                'price' => $product->price ?? '0', // Lưu dạng string như database
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $userId = Auth::id();
        Cart::where('user_id', $userId)->where('id', $id)->delete();
        return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm!']);
    }

    // Cập nhật số lượng sản phẩm
    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $cartItem = Cart::where('user_id', $userId)->where('id', $id)->first();

        if ($cartItem && $request->quantity > 0) {
            $cartItem->update(['quantity' => $request->quantity]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    // Thanh toán
    public function checkout(Request $request)
    {
        try {
            $userId = Auth::id();
            
            if (!$userId) {
                return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
            }
            
            $cartItems = Cart::where('user_id', $userId)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Giỏ hàng trống!']);
            }

            // Tính tổng
            $total = 0;
            foreach ($cartItems as $item) {
                $price = (float) preg_replace('/[^0-9]/', '', $item->price);
                $total += $price * $item->quantity;
            }

            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'total' => $total,
                'payment_method' => $request->payment_method ?? 'COD',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_name' => $item->product_name,
                    'product_image' => $item->product_image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            Cart::where('user_id', $userId)->delete();

            return response()->json(['success' => true, 'message' => 'Đặt hàng thành công!']);
            
        } catch (\Exception $e) {
            Log::error('Checkout error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
}