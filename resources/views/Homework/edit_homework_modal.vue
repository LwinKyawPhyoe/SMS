<template>
<div class="modal-dialog modal-lg">
    <div class="modal-content modal-media-content">
        <div class="sub-header" style="padding: 0px 15px;margin: 0px;">
            <h6>Edit Homework</h6>
            <i class="fa fa-times time modal_close_btn" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding: 10px 0px;">
            <div class="row" id="row" style="margin: 0px;">
                <div class="col-lg-4 col-12">
                    <label for="name" class="title">Class
                        <strong>*</strong>
                    </label>
                    <select class="inputbox" name="class">
                        <option selected disabled>Select Class</option>
                        <option value="Class 1">Class 1</option>
                        <option value="Class 2">Class 2</option>
                        <option value="Class 3">Class 2</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="name" class="title">Section
                        <strong>*</strong>
                    </label>
                    <select class="inputbox" name="class">
                        <option selected disabled>Select Section</option>
                        <option value="Section A">Section A</option>
                        <option value="Section B">Section B</option>
                        <option value="Section C">Section C</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="name" class="title">Subject
                        <strong>*</strong>
                    </label>
                    <select class="inputbox" name="class">
                        <option selected disabled>Select Subject</option>
                        <option value="Subject 1">Subject 1</option>
                        <option value="Subject 2">Subject 2</option>
                        <option value="Subject 3">Subject 3</option>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="uploadDate">Homework Date</label>
                    <input type="date" class="inputbox" id="uploadDate">
                </div>
                <div class="col-lg-4 col-12">
                    <label for="uploadDate">Submission Date</label>
                    <input type="date" class="inputbox" id="uploadDate">
                </div>
                <div class="col-lg-4 col-12">
                    <label for="faPhoto">Attach Document</label>
                    <input type="file" class="inputbox" id="faPhoto">
                </div>
                <div  class="col-sm-12 col-lg-12 col-12" style="margin-top: 10px">
                    <label for="name" class="title">Description
                        <strong>*</strong>
                    </label>
                    <wysiwyg />
                </div>
            </div>
        </div>
        <div class="modal-footer" style="padding: 10px 15px;">
            <button class="save" id="globalSave" style="margin: 0px;">Save</button>
        </div>
    </div>
</div>
</template>