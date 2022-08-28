<div class="modal fade" id="editCalendar" tabindex="-1" role="dialog" aria- labelledby="editCalendarLabel"
    aria-hidden="true">


    <form action="" id="editCalendar_form">

        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCalendarLabel">تعديل معلومات الحجز</h5>
                    <button type="button" class="close" data-dismiss="modal" aria- label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <button type="submit" class="btn btn-danger delete_Calendar">حذف الحجز</button>

                </div>

                <div class="modal-body row">

                    <div class="errMsgContainer mb-3" id="errMsgContainer"></div>

                    <div class="col-md-4">
                        <label class="form-label required">عنوان</label>
                        <input name="edit_title" id="edit_title" type="text" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">اسم المريض</label>
                        <input name="edit_patient" id="edit_patient" type="text" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">وصف</label>
                        <input name="edit_description" id="edit_description" type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label required">بداية الحجز</label>
                        <input name="edit_start_time" id="edit_start_time" type="time" class="form-control">
                    </div>


                    <div class="col-md-3">
                        <label class="form-label required">نهاية الحجز</label>
                        <input name="edit_end" id="edit_end" type="date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">-</label>
                        <input name="edit_end_time" id="edit_end_time" type="time" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary edit_Calendar">اعتماد</button>
                </div>

            </div>
        </div>

    </form>
</div>
