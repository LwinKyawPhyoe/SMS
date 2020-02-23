<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                Examinations
            </h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home </router-link> > <router-link to="/MarkRegister" class="home">Marks Register </router-link> > Add Fill Marks
            </h4>
        </div>
        <hr>

        <div class="card">
            <div class="card-header">
                <h6>Select Fill Marks</h6>
            </div>
            <div class="card-body">
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name">Exam Name
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Test-Month</option>
                            <option value="Unit Test-January">Unit Test-January</option>
                            <option value="Unit Test-February">Unit Test-February</option>
                            <option value="Unit Test-March">Unit Test-March</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name">Class
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Class</option>
                            <option value="Class A">Class A</option>
                            <option value="Class B">Class B</option>
                            <option value="Class C">Class C</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name">Section</label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Section</option>
                            <option value="Section A">Section A</option>
                            <option value="Section B">Section B</option>
                            <option value="Section C">Section C</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button id="globalSearch" class="searchButton">Search</button>
                    </div>
                </div>
            </div>

            <div class="sub-header">
                <h6>Fill Marks</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">            
                    <table class="table table-hover table-striped" style="display: block;overflow-y: auto;" id="studenttable">
                        <thead>
                            <tr style="font-size:14px;">
                                <th class="all" nowrap>Adminission Number</th>
                                <th class="all" nowrap>Roll Number</th>
                                <th class="all" nowrap>Student</th>
                                <th class="all" nowrap>Myanmar (TH:4/10)</th>
                                <th class="all" nowrap>English (TH:8/15)</th>
                                <th class="all" nowrap>Mathematics (TH:8/15)</th>
                                <th class="all" nowrap>Chemistry (TH:8/15)</th>
                                <th class="all" nowrap>Physics (TH:8/15)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                                <td class="all" nowrap>18012</td>
                                <td class="all" nowrap>113</td>
                                <td class="all" nowrap>Gates</td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="9.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="12.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="8.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="11.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="9.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                            </tr>
                            <tr class="active" style="border-bottom: 1px solid #ebebeb;">
                                <td class="all" nowrap>18013</td>
                                <td class="all" nowrap>114</td>
                                <td class="all" nowrap>Din</td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="9.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="12.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="8.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="11.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="checkLabel"><input type="checkbox" value="ABS" autocomplete="off">Abs</label>
                                        </div>
                                        <input type="hidden" name="subject_id" value="1">
                                        <input type="text" class="inputbox" value="9.00" placeholder="Enter Marks" autocomplete="off">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="save" id="globalSave">Save</button>
                </div>
            </div>
        </div>

    </div>
</template>