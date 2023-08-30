@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">待辦事項</span></h4>

        @for($i=0;$i<=5;$i++)
            <div class="divider text-start-center">
                <div class="divider-text">案件Ａ</div>
            </div>
            @for($j=0;$j<=2;$j++)
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <h5 class="card-header">
                                <div class="form-check">
                                    <input class="form-check-input todo-check-btn" type="checkbox" value="" id="defaultCheck3">
                                    <label class="form-check-label" for="defaultCheck3">xxx安排諮詢時間</label>
                                    <button class="btn-sm btn-primary me-1 collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $i . '-' . $j }}"
                                            aria-expanded="false" aria-controls="collapseExample">展開
                                    </button>
                                </div>
{{--                                <input class="form-check-inline" type="checkbox" name="">xxx安排諮詢時間--}}
{{--                                <button class="btn-sm btn-primary me-1 collapsed" type="button"--}}
{{--                                        data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $i . '-' . $j }}"--}}
{{--                                        aria-expanded="false" aria-controls="collapseExample">展開--}}
{{--                                </button>--}}
                            </h5>
                            <div class="card-body">
                                <div class="collapse" id="collapseExample{{ $i . '-' . $j }}" style="">
                                    <p>到期時間：</p>
                                    <p>裝態：助理Ａ．助理Ｂ確認完成</p>
                                    <p>連結：http://google.com</p>
                                    <p>描述：開庭資料應包含照片．錄影黨</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        @endfor
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">完成此項目？</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="quick_select_btn">確定</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // 在這裡放置你的 JavaScript 代碼
        $(document).ready(function () {
            // 當「Toggle Sidebar」按鈕被點擊時，切換 Sidebar 的顯示狀態
            $('#toggle-sidebar-btn').click(function () {
                $('#sidebar').toggleClass('d-none');
                $('#main-content').toggleClass('col-md-9 col-md-12');
            });
        });

        $(".todo-check-btn").click(function () {
            $('#modalCenter').modal('show');
        })
    </script>
@endsection
