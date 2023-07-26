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
