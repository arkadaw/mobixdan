@extends('layouts.store')
@section('title', $pageTitle.' | موبیکس هاب')
@section('content')<section class="wrap page-head"><span class="eyebrow">موبیکس هاب</span><h1>{{ $pageTitle }}</h1></section><section class="wrap static-page"><p>{{ $pageText }}</p>@if($pageTitle==='تماس با ما')<div class="contact-links"><a href="https://ble.ir/supportmobixhub" target="_blank" rel="noopener">پشتیبانی بله</a><a href="https://wa.me/989353055697" target="_blank" rel="noopener">واتساپ</a><a href="https://t.me/mobixhubsupport" target="_blank" rel="noopener">تلگرام</a></div>@endif</section>@endsection
