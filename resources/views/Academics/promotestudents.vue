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
                        <label for="name" class="title">
                            Class
                            <strong>*</strong>
                        </label>
                        <select id="classid" @change="changeClass(PromoteStudObj.class_id)" class="inputbox" name="class" v-model="PromoteStudObj.class_id">                              
                            <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                        </select>
                        <span id="classmsg" class="error_message">Class is required</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                        <label for="name" class="title">Section
                            <strong>*</strong>
                        </label>
                        <select id="sectionid" @change="changeSection(PromoteStudObj.section_id)" class="inputbox" name="class" v-model="PromoteStudObj.section_id">
                            <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                        </select>
                        <span id="sectionmsg" class="error_message">Section is required</span>
                    </div>
                    <div class="col-12">
                        <button class="searchButton" id="globalSearch">Search</button>
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
                    <button class="save" id="globalSave" style="margin:0 0 1rem;">Promote</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            PromoteStudObj: { "class_id": "", "section_id": ""},
            ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}],
            SectionList: [{"id":0,"section":"Class Section"}],
        }
    },
    created() {
        this.getAllClass();
    },
    methods: {
        getAllClass() {
            this.axios.get("/api/class").then(response => {        
                this.sortList(response.data);        
            });
        },

        sortList(aList){       
            for(let i=0; i < aList.length; i++){
                if(this.ClassList == [] || this.ClassList.length == 0){
                    let obj = [];
                    obj.push({"id": aList[i].sectionid, "section": aList[i].section});
                    this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj});
                }
                else{
                    let check = 0;
                    for(let a=0; a < this.ClassList.length; a++){
                        if(this.ClassList[a].class == aList[i].class){              
                            this.ClassList[a].section.push({"id": aList[i].sectionid, "section": aList[i].section});
                            check = 1;
                        }
                    }

                    if(check == 0)
                    {
                        let obj1 = [];
                        obj1.push({"id": aList[i].sectionid, "section": aList[i].section});
                        this.ClassList.push({"id": aList[i].classid,"class": aList[i].class, "section": obj1});
                    }
                }
            }
            this.PromoteStudObj.class_id = this.ClassList[0].id;
            this.PromoteStudObj.section_id = this.SectionList[0].id;
        },

        changeClass(aId){
            this.SectionList = [];
            this.SectionList = [{"id":0,"section":"Class Section"}];
            if(aId != 0)
            {
                for(let i=0; i<this.ClassList.length;i++){
                    if(this.ClassList[i].id == aId){
                        for(let a=0; a<this.ClassList[i].section.length; a++){
                            this.SectionList.push(this.ClassList[i].section[a]);
                        }
                        break;
                    }
                }
            }
            this.PromoteStudObj.section_id = this.SectionList[0].id;
            if(this.PromoteStudObj.class_id == 0)
            {
                $('#classid').css('border', '1px solid red');
            }
            else
            {
                $('#classmsg').css('display', 'none');
                $('#classid').css('border', '1px solid #d2d6de');
            }
        },

        changeSection(aId)
        {            
            if(aId == 0)   $('#sectionid').css('border', '1px solid red');
            else
            {
                $('#sectionmsg').css('display', 'none');        
                $('#sectionid').css('border', '1px solid #d2d6de');
            }
        },
    }
}
</script>