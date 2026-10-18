
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>موبیکس هاب | فروشگاه جانبی موبایل</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            color: #222;
            background: #f7f7f7;
        }
        header {
            background: #fff;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }
        .logo { font-size: 23px; font-weight: bold; }
        .logo span { color: #d71920; }
        nav a {
            color: #444;
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
        }
        .hero {
            margin: 28px auto;
            width: 88%;
            padding: 65px 35px;
            background: #fff;
            border-radius: 14px;
        }
        .hero h1 { font-size: 32px; margin-top: 0; }
        .hero p { color: #666; line-height: 2; }
        .button {
            display: inline-block;
            background: #d71920;
            color: white;
            padding: 13px 24px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 12px;
        }
        .section { width: 88%; margin: 35px auto; }
        .products {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
        .product {
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
        }
        footer {
            padding: 25px;
            text-align: center;
            color: #777;
            font-size: 13px;
        }
        @media (max-width: 650px) {
            header { padding: 16px 5%; }
            nav a { margin-right: 10px; font-size: 12px; }
            .hero { padding: 40px 22px; }
            .hero h1 { font-size: 25px; }
            .products { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">موبیکس <span>هاب</span></div>
        <nav>
            <a href="/">خانه</a>
            <a href="#products">محصولات</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>لوازم جانبی موبایل، ساده و کاربردی</h1>
            <p>به فروشگاه جانبی موبیکس هاب خوش آمدید</p>
            <a class="button" href="#products">مشاهده محصولات</a>
        </section>

        <section class="section" id="products">
            <h2>محصولات فروشگاه</h2>
            <div class="products">
                <article class="product">محصول شماره یک</article>
                <article class="product">محصول شماره دو</article>
                <article class="product">محصول شماره سه</article>
            </div>
        </section>
    </main>

    <footer>فروشگاه جانبی موبیکس هاب</footer>
</body>
</html>
