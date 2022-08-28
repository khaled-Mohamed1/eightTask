<div class="modal fade" id="addCalendar" tabindex="-1" role="dialog" aria- labelledby="addCalendarLabel" aria-hidden="true">


    <form action="" id="addCalendar_form">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCalendarLabel">اضافة معلومات الحجز</h5>
                    <button type="button" class="close" data-dismiss="modal" aria- label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row">

                    <div class="errMsgContainer mb-3" id="errMsgContainer"></div>

                    <div class="col-md-4">
                        <label class="form-label required">عنوان</label>
                        <input name="title" id="title" type="text" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">اسم المريض</label>
                        <input name="patient" id="patient" type="text" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">وصف</label>
                        <input name="description" id="description" type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label required">بداية الحجز</label>
                        <input name="start_time" id="start_time" type="time" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label required">نهاية الحجز</label>
                        <input name="end" id="end" type="date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">-</label>
                        <input name="end_time" id="end_time" type="time" class="form-control">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add_Calendar">اعتماد</button>
                </div>

            </div>
        </div>

    </form>
</div>
