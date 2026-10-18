<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'موبیکس هاب | فروشگاه آنلاین لوازم جانبی موبایل')</title>
    <meta name="description" content="خرید آنلاین لوازم جانبی موبایل و محصولات کاربردی از موبیکس هاب">
    <meta name="theme-color" content="#d71920">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>
<div class="topline">خرید آسان لوازم جانبی موبایل <span>پشتیبانی آنلاین موبیکس هاب</span></div>
<header class="site-header wrap">
    <a class="brand" href="{{ route('home') }}"><span class="brand-mark">M</span><span><b>موبیکس هاب</b><small>فروشگاه آنلاین</small></span></a>
    <form class="search" action="{{ route('products.index') }}" method="get"><input name="q" value="{{ request('q') }}" placeholder="دنبال چه محصولی می‌گردی؟" aria-label="جست‌وجوی محصول"><button aria-label="جست‌وجو">⌕</button></form>
    <nav class="header-actions"><a href="{{ route('products.index') }}">محصولات</a><a class="cart-link" href="{{ route('cart.index') }}"><span>سبد خرید</span><span class="cart-count">{{ array_sum(session('cart', [])) }}</span></a></nav>
</header>
<nav class="category-nav"><div class="wrap nav-inner"><a href="{{ route('products.index') }}">همه محصولات</a><a href="{{ route('categories.show', 'mobile-accessories') }}">لوازم جانبی موبایل</a><a href="{{ route('categories.show', 'holders') }}">پایه و نگهدارنده</a><a href="{{ route('categories.show', 'cables-chargers') }}">کابل و شارژر</a><a href="{{ route('contact') }}">تماس با ما</a></div></nav>
@if(session('success'))<div class="wrap flash">{{ session('success') }}</div>@endif
<main>@yield('content')</main>
<footer class="footer"><div class="wrap footer-grid"><div><a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-mark">M</span><span><b>موبیکس هاب</b><small>فروشگاه آنلاین</small></span></a><p>انتخابی ساده برای لوازم جانبی کاربردی موبایل.</p></div><div><b>دسترسی سریع</b><a href="{{ route('products.index') }}">همه محصولات</a><a href="{{ route('about') }}">درباره ما</a><a href="{{ route('contact') }}">تماس با ما</a></div><div><b>راهنمای خرید</b><a href="{{ route('cart.index') }}">سبد خرید</a><a href="{{ route('terms') }}">قوانین و مقررات</a><span>پاسخ‌گویی آنلاین</span></div></div><div class="footer-bottom">© موبیکس هاب - تمامی حقوق محفوظ است</div></footer>
<script src="{{ asset('js/store.js') }}" defer></script>
</body></html>
