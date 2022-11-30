<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- bootstrapの使用 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header>
        <div id="head" class="head-container">
        <h1><a href="/top"><img src="{{ asset('images/atlas.png') }}" class="atlas-img"></a></h1>
            <div class="head-content">
                <p class="head-name">{{ Auth::user()->username }}</p><p class="head-name">さん</p>
                <div class="menu">
                    <input type = "checkbox" id = "accordion">
                    <label for = "accordion"></label>
                    <ul id = "accordion-content">
                        <li><a href="/top">HOME</a></li>
                        <li><a href="/profile">プロフィール編集</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div>
                <img src="{{ asset('storage/' .Auth::user()->images)}}" alt="アイコン" class="icon">
            </div>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div class="count">
                    <p>フォロー数</p>
                    <p>{{ DB::table('follows')->where('following_id', Auth::User()->id)->count() }}名</p>
                </div>
                <p class="btn btn-primary page-list"><a href="/follow-list" class="link">フォローリスト</a></p>
                <div class="count">
                    <p>フォロワー数</p>
                    <p>{{ DB::table('follows')->where('followed_id', Auth::User()->id)->count() }}名</p>
                </div>
                <p class="btn btn-primary page-list"><a href="/follower-list" class="link">フォロワーリスト</a></p>
            </div>
            <p class="btn btn-primary page-search"><a href="/search" class="link">ユーザー検索</a></p>
        </div>
    </div>

    <footer>
    </footer>

    <!-- jQueryをインストールした場合はこっちを使用。必ず上に記載 -->
    <!-- <script src="js/jquery-3.6.1.min.js"></script> -->

    <!-- jQueryをCDN経由でインストールした場合はこっちを記載 -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- jsのファイルパスの書き方はassetあってもなくてもどっちでもOK？ -->
    <!-- <script src="{{ asset('/js/script.js') }}"></script> -->
    <script src="js/script.js"></script>

    <!-- jQueryが動作してるか確認用 -->
    <!-- <script>alert('hello world')</script> -->

    <!-- bootstrapの使用 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
