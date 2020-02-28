<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                Academics
            </h2>
            <h4 class="stuLink">
                <a href="" style="text-decoration:none;color:#1b5e20;">Home </a> > Promote Student
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;">

        <div class="card">
            <div class="card-header">
                <h6>Select Criteria</h6>
            </div>
            <div class="card-body">
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                        <label for="name" class="title">Class
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Class</option>
                            <option value="Class A">Class A</option>
                            <option value="Class B">Class B</option>
                            <option value="Class C">Class C</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 textbox">
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
                    <div class="col-12">
                        <button class="searchButton">Search</button>
                    </div>
                </div>
            </div>

            <div class="sub-header">
                <h6>Promote Students In Next Session</h6>
            </div>
            <div class="card-body">
                    
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name" class="title">Promote In Session
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Session</option>
                            <option value="2019-20">2019-20</option>
                            <option value="2020-21">2020-21</option>                            
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name" class="title">Class
                            <strong>*</strong>
                        </label>
                        <select class="inputbox" name="class">
                            <option selected disabled>Select Class</option>
                            <option value="Class 1">Class 1</option>
                            <option value="Class 2">Class 2</option>
                            <option value="Class 3">Class 3</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
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
                </div>

                <div class="row" id="row" style="width:100%;padding:0;">
                    <div class="table-responsive">            
                        <table class="table table-hover table-striped" style="margin-bottom: 0;" id="studenttable">
                            <thead>
                                <tr>
                                    <th class="all" nowrap>Admission Number</th>
                                    <th class="all" nowrap>Student Name</th>
                                    <th class="all" nowrap>Father Name</th>
                                    <th class="all" nowrap>Date Of Birth</th>
                                    <th class="all" colspan="2" nowrap>Current Result</th>
                                    <th class="all" colspan="2" nowrap>Next Session Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="active">
                                    <td class="all" nowrap>18001</td>
                                    <td class="all" nowrap>Edward Thomas</td>
                                    <td class="all" nowrap>Olivier Thomas</td>
                                    <td class="all" nowrap>09/03/2005</td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="Examresult" checked value="Pass" /> Pass
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="Examresult" value="Fail" /> Fail
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="nextsessionstatus" checked value="Continue" /> Continue
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="nextsessionstatus" value="Leave" /> Leave
                                        </label>
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td class="all" nowrap>18002</td>
                                    <td class="all" nowrap>Robin Peterson</td>
                                    <td class="all" nowrap>Lucas Peterson</td>
                                    <td class="all" nowrap>03/15/2006</td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="Examresult1" checked value="Pass" /> Pass
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="Examresult1" value="Fail" /> Fail
                                        </label>
                                    </td>

                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="nextsessionstatus1" checked value="Continue" /> Continue
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline">
                                            <input type="radio" name="nextsessionstatus1" value="Leave" /> Leave
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr />
                <div class="col-12">
                    <button class="save" style="margin:0 0 1rem;">Promote</button>
                </div>
            </div>
        </div>
    </div>
</template>