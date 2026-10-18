@extends('layouts.store')
@section('title', 'ثبت سفارش | موبیکس هاب')
@section('content')<section class="wrap order-success"><div class="success-icon">✓</div><span class="eyebrow">سفارش ثبت شد</span><h1>ممنون از خریدت</h1><p>شماره سفارش آزمایشی شما:</p><strong class="order-number">{{ $order['number'] }}</strong><p class="notice">این نسخه هنوز پرداخت آنلاین و ذخیره دائمی سفارش در دیتابیس ندارد. با پاک‌شدن نشست مرورگر، این اطلاعات ممکن است از دست برود.</p><a class="btn btn-primary" href="{{ route('products.index') }}">بازگشت به فروشگاه</a></section>@endsection
