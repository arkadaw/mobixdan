<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StorefrontController extends Controller
{
    private function catalog(): array
    {
        return [
            ['id'=>1,'name'=>'کیت بزرگنمایی صفحه موبایل','slug'=>'mobile-screen-magnifier','price'=>260000,'old_price'=>320000,'category'=>'لوازم جانبی موبایل','category_slug'=>'mobile-accessories','image'=>'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=85','description'=>'بزرگ‌نمایی تصویر موبایل برای تماشای فیلم و ویدئو با صفحه‌ای بزرگ‌تر. بدون نیاز به برق، باتری یا نصب برنامه.','featured'=>true,'stock'=>18],
            ['id'=>2,'name'=>'پایه نگهدارنده موبایل','slug'=>'phone-holder','price'=>185000,'old_price'=>null,'category'=>'پایه و نگهدارنده','category_slug'=>'holders','image'=>'https://images.unsplash.com/photo-1586953208448-b95a79798f07?auto=format&fit=crop&w=900&q=85','description'=>'پایه کاربردی برای قرار دادن موبایل روی میز و استفاده روزمره.','featured'=>true,'stock'=>24],
            ['id'=>3,'name'=>'کابل شارژ USB','slug'=>'usb-charging-cable','price'=>99000,'old_price'=>129000,'category'=>'کابل و شارژر','category_slug'=>'cables-chargers','image'=>'https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?auto=format&fit=crop&w=900&q=85','description'=>'کابل شارژ مناسب استفاده روزمره با طراحی جمع‌وجور.','featured'=>false,'stock'=>40],
            ['id'=>4,'name'=>'هولدر رومیزی تاشو','slug'=>'foldable-desk-holder','price'=>149000,'old_price'=>null,'category'=>'پایه و نگهدارنده','category_slug'=>'holders','image'=>'https://images.unsplash.com/photo-1601784551446-20c9e07cdbdb?auto=format&fit=crop&w=900&q=85','description'=>'نگهدارنده تاشو برای تماشای محتوا و تماس تصویری.','featured'=>true,'stock'=>12],
            ['id'=>5,'name'=>'محافظ صفحه موبایل','slug'=>'screen-protector','price'=>79000,'old_price'=>95000,'category'=>'لوازم جانبی موبایل','category_slug'=>'mobile-accessories','image'=>'https://images.unsplash.com/photo-1605236453806-6ff36851218e?auto=format&fit=crop&w=900&q=85','description'=>'محافظ صفحه برای کمک به محافظت روزمره از نمایشگر.','featured'=>false,'stock'=>35],
            ['id'=>6,'name'=>'کیف نظم‌دهنده کابل','slug'=>'cable-organizer','price'=>119000,'old_price'=>null,'category'=>'لوازم جانبی','category_slug'=>'accessories','image'=>'https://images.unsplash.com/photo-1556656793-08538906a9f8?auto=format&fit=crop&w=900&q=85','description'=>'کیف کوچک و سبک برای مرتب نگه‌داشتن کابل‌ها و لوازم جانبی.','featured'=>false,'stock'=>16],
        ];
    }

    private function categories(): array
    {
        return [
            ['name'=>'لوازم جانبی موبایل','slug'=>'mobile-accessories','icon'=>'▣'],
            ['name'=>'پایه و نگهدارنده','slug'=>'holders','icon'=>'⌁'],
            ['name'=>'کابل و شارژر','slug'=>'cables-chargers','icon'=>'ϟ'],
            ['name'=>'لوازم جانبی','slug'=>'accessories','icon'=>'✳'],
        ];
    }

    private function cartData(): array
    {
        $catalog = collect($this->catalog())->keyBy('id');
        $cart = session('cart', []);
        $items = collect($cart)->map(function ($quantity, $id) use ($catalog) {
            $product = $catalog->get((int) $id);
            if (!$product) return null;
            $product['quantity'] = min((int) $quantity, $product['stock']);
            $product['line_total'] = $product['price'] * $product['quantity'];
            return $product;
        })->filter()->values();
        return ['items'=>$items, 'subtotal'=>$items->sum('line_total'), 'count'=>$items->sum('quantity')];
    }

    public function home()
    {
        $products = collect($this->catalog());
        return view('store.home', ['categories'=>$this->categories(), 'featured'=>$products->where('featured', true), 'latest'=>$products->take(4)]);
    }

    public function products(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        $sort = $request->query('sort', 'newest');
        $products = collect($this->catalog());
        if ($query !== '') $products = $products->filter(fn($p) => Str::contains(mb_strtolower($p['name']), mb_strtolower($query)));
        if ($request->filled('category')) $products = $products->where('category_slug', $request->query('category'));
        if ($sort === 'price_asc') $products = $products->sortBy('price');
        elseif ($sort === 'price_desc') $products = $products->sortByDesc('price');
        else $products = $products->sortByDesc('id');
        return view('store.products', ['products'=>$products->values(), 'categories'=>$this->categories(), 'search'=>$query, 'sort'=>$sort, 'pageTitle'=>'همه محصولات']);
    }

    public function category(string $slug)
    {
        $category = collect($this->categories())->firstWhere('slug', $slug);
        abort_unless($category, 404);
        $products = collect($this->catalog())->where('category_slug', $slug)->values();
        return view('store.products', ['products'=>$products, 'categories'=>$this->categories(), 'search'=>'', 'sort'=>'newest', 'pageTitle'=>$category['name']]);
    }

    public function product(string $slug)
    {
        $product = collect($this->catalog())->firstWhere('slug', $slug);
        abort_unless($product, 404);
        $related = collect($this->catalog())->where('category_slug', $product['category_slug'])->where('id', '!=', $product['id'])->take(4);
        return view('store.product', compact('product', 'related'));
    }

    public function cart() { return view('store.cart', $this->cartData()); }

    public function addToCart(Request $request, int $id)
    {
        $product = collect($this->catalog())->firstWhere('id', $id);
        abort_unless($product, 404);
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = session('cart', []);
        $cart[$id] = min(($cart[$id] ?? 0) + $quantity, $product['stock']);
        session(['cart'=>$cart]);
        return back()->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    public function updateCart(Request $request, int $id)
    {
        $product = collect($this->catalog())->firstWhere('id', $id);
        abort_unless($product, 404);
        $quantity = (int) $request->validate(['quantity'=>'required|integer|min:1|max:'.$product['stock']])['quantity'];
        $cart = session('cart', []); $cart[$id] = $quantity; session(['cart'=>$cart]);
        return redirect()->route('cart.index')->with('success', 'تعداد محصول به‌روزرسانی شد.');
    }

    public function removeFromCart(int $id)
    {
        $cart = session('cart', []); unset($cart[$id]); session(['cart'=>$cart]);
        return redirect()->route('cart.index')->with('success', 'محصول از سبد خرید حذف شد.');
    }

    public function checkout()
    {
        $data = $this->cartData();
        if ($data['items']->isEmpty()) return redirect()->route('cart.index');
        return view('store.checkout', $data);
    }

    public function placeOrder(Request $request)
    {
        $data = $this->cartData();
        if ($data['items']->isEmpty()) return redirect()->route('cart.index');
        $validated = $request->validate([
            'name'=>'required|string|max:120', 'phone'=>'required|string|max:20',
            'province'=>'required|string|max:100', 'city'=>'required|string|max:100',
            'address'=>'required|string|max:1000', 'postal_code'=>'nullable|string|max:20',
            'note'=>'nullable|string|max:1000',
        ]);
        // مرحله فعلی: ثبت نمایشی سفارش تا زمان اضافه‌شدن دیتابیس سفارش و درگاه پرداخت.
        $orderNumber = 'MH-' . now()->format('ymd') . '-' . strtoupper(Str::random(5));
        session(['last_order'=>['number'=>$orderNumber, 'customer'=>$validated, 'items'=>$data['items']->all(), 'total'=>$data['subtotal'], 'created_at'=>now()->toDateTimeString()]]);
        session()->forget('cart');
        return view('store.order-success', ['order'=>session('last_order')]);
    }
}
