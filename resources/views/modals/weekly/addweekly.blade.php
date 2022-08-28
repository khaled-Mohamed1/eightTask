<div class="modal fade" id="addWeekly" tabindex="-1" role="dialog" aria- labelledby="addWeeklyLabel" aria-hidden="true">


    <form action="" id="addWeekly_form">
        @csrf

        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWeeklyLabel">اضافة معلومات الحجز</h5>
                    <button type="button" class="close" data-dismiss="modal" aria- label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body row">

                    <div class="errMsgContainer mb-3" id="errMsgContainer"></div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label required">عنوان</label>
                            <input name="week_title" id="week_title" type="text" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">اسم المريض</label>
                            <input name="week_patient" id="week_patient" type="text" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">وصف</label>
                            <input name="week_description" id="week_description" type="text" class="form-control">
                        </div>
                    </div>

                    <div style="width: 150px">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="week" name="weekly">
                            <label class="form-check-label">
                                اسبوع الحالي
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="between_date" name="weekly">
                            <label class="form-check-label">
                                فترة معينة
                            </label>
                        </div>
                    </div>



                    <div class="between_date" style="display: none">

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label fs-4">بداية الحجز</label>
                                <input name="between_start" id="between_start" type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-4">نهاية الحجز</label>
                                <input name="between_end" id="between_end" type="date" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-3">الأيام</label>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fs-3">بداية الحجز</label>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fs-3">نهاية الحجز</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">السبت</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Saturday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Saturday">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">ألأحد</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Sunday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Sunday">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">الاثنين</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Monday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Monday">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">الثلاثاء</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Tuesday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Tuesday">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">الأربعاء</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Wednesday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Wednesday">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">الخميس</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Thursday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Thursday">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label fs-5">الجمعة</label>
                        </div>
                        <div class="col-md-5">
                            <input name="week_start_time[]" id="week_start_time" type="time"
                                class="form-control week_start_time Friday">
                        </div>
                        <div class="col-md-5">
                            <input name="week_end_time[]" id="week_end_time" type="time"
                                class="form-control week_end_time Friday">
                        </div>
                    </div>

                </div>

                <div class="modal-footer" id="add_Weekly" style="display: none">
                    <button type="submit" class="btn btn-primary add_Weekly">اعتماد</button>
                </div>

                <div class="modal-footer" id="addBetween_Weekly" style="display: none">
                    <button type="submit" class="btn btn-primary addBetween_Weekly">اعتماد</button>
                </div>

            </div>
        </div>

    </form>
</div>
