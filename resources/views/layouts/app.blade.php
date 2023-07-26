<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- 引用編譯後的 CSS 檔案 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap">

    <style>

        body {
            font-family: 'Noto Sans', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .navbar {
            margin-bottom: 20px;
        }
        @yield('css')
    </style>
</head>
<body class="bg-light">
<main>
    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Always expand</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02"
                    aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/events') }}">建立事件</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/costs') }}">查看費用紀錄</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/hours/create') }}">時數登錄</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/hours') }}">查看時數登錄</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/hours/export') }}">匯出時數</a>
                    </li>
                </ul>
                <form>
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
</main>
<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script src="offcanvas.js"></script>


<!-- 引用編譯後的 JavaScript 檔案 -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
