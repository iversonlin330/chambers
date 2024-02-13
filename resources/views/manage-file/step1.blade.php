@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">步驟一：選擇檔案</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>選擇</th>
                            <th>檔名</th>
                            <th>歸檔檔名</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($files as $file)
                            <tr data-id="{{ $loop->index }}">
                                <td>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="{{ $file }}" id="defaultCheck1"/>
                                        <label class="form-check-label" for="defaultCheck1"></label>
                                    </div>
                                </td>
                                <td>{{ $file }}</td>
                                <td>
                                    {{--                                    <input type="text" class="form-control">--}}
                                    {{--                                    <select class="form-select" name="" id="">--}}
                                    {{--                                        <option value="">開庭通知書</option>--}}
                                    {{--                                        <option value="">交通費收據</option>--}}
                                    {{--                                    </select>--}}
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="歸檔檔名" aria-label="歸檔檔名"
                                               aria-describedby="button-addon2" id="input_{{ $loop->index }}">
                                        <button class="btn btn-outline-primary quick_modal_btn" type="button"
                                                id="button-addon2">快選
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-sm-6">
                        {{--                        <button type="submit" class="btn btn-primary">下一步</button>--}}
                        <a class="btn btn-primary" href="{{ url('manage-files/step2') }}">下一步</a>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">歸檔檔名快選</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <select class="form-select" name="" id="quick_select">
                                <option value="開庭通知書">開庭通知書</option>
                                <option value="交通費收據">交通費收據</option>
                            </select>
                        </div>
                    </div>
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

        $(".quick_modal_btn").click(function () {
            let data_id = $(this).closest('tr').data('id');
            $("#quick_select_btn").attr('data-id', data_id);
            $('#modalCenter').modal('show');
        })

        $("#quick_select_btn").click(function () {
            let input_val = $("#quick_select").val();
            let data_id = $(this).attr('data-id');
            console.log(data_id);
            $("#input_" + data_id).val(input_val);
            console.log("#input_" + data_id);
            $('#modalCenter').modal('hide');
        })
    </script>
@endsection
