
<div class="modal fade" id="crateStatus" role="dialog" style="z-index: 3001;" dir="rtl">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">وضعیت</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="share_name"/>
                    </div>
                    <button type="submit" class="btn btn-block btn-link">بزن بریم</button>
                </form>
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>