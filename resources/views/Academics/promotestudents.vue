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
                <message :alertmessage="msg" id="alertmsg"/>
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                        <label for="name" class="title">
                            Class
                            <strong>*</strong>
                        </label>
                        <select id="classid" @change="changeClass(SearchStudObj.class_id)" class="inputbox" name="class" v-model="SearchStudObj.class_id">                              
                            <option v-for="Classes in ClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                        </select>
                        <span id="classmsg" class="error_message">Class is required</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 textbox">
                        <label for="name" class="title">Section
                            <strong>*</strong>
                        </label>
                        <select id="sectionid" @change="changeSection(SearchStudObj.section_id)" class="inputbox" name="class" v-model="SearchStudObj.section_id">
                            <option v-for="Section in SectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                        </select>
                        <span id="sectionmsg" class="error_message">Section is required</span>
                    </div>
                    <div class="col-12">
                        <button @click="goSearch()" class="searchButton" id="globalSearch">Search</button>
                    </div>
                </div>
            </div>

            <div v-if="showStudRecord" class="sub-header">
                <h6>Promote Students In Next Session</h6>
            </div>
            <div v-if="showStudRecord" class="card-body">                   
                <div class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name" class="title">Promote In Session
                            <strong>*</strong>
                        </label>                        
                        <select id="promotesessionid" @change="changePromoteSession(PromoteStudObj.promote_session)" class="inputbox" name="class" v-model="PromoteStudObj.promote_session">
                            <option v-for="session in sessionList" :key="session.id" :value="session.id">{{session.session}}</option>
                        </select>
                        <span id="promotesessionmsg" class="error_message">Session is required</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name" class="title">Class
                            <strong>*</strong>
                        </label>
                        <select id="promoteclassid" @change="changePromoteClass(PromoteStudObj.class_id)" class="inputbox" name="class" v-model="PromoteStudObj.class_id">                              
                            <option v-for="Classes in PromoteClassList" :key="Classes.id" :value="Classes.id">{{Classes.class}}</option>                
                        </select>
                        <span id="promoteclassmsg" class="error_message">Class is required</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label for="name" class="title">Section
                            <strong>*</strong>
                        </label>                        
                        <select id="promotesectionid" @change="changePromoteSection(PromoteStudObj.section_id)" class="inputbox" name="class" v-model="PromoteStudObj.section_id">
                            <option v-for="Section in PromoteSectionList" :key="Section.id" :value="Section.id">{{Section.section}}</option>
                        </select>
                        <span id="promotesectionmsg" class="error_message">Section is required</span>
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
                                <tr v-for="item in PromoteObj" :key="item.id" class="active">
                                    <td class="all" nowrap>{{ item.admission_no }}</td>
                                    <td class="all" nowrap>{{ item.student_name }}</td>
                                    <td class="all" nowrap>{{ item.father_name }}</td>
                                    <td class="all" nowrap>{{ item.dob }}</td>
                                    <td>
                                        <label class="radio-inline" style="display: inline-block; margin-bottom: .5rem; margin-top: 15px;">
                                            <input type="radio" :name="item.admission_no" checked value="Pass" :v-model="item.result" @click="clickResult_Radio($event, 'Pass',item.admission_no)"/> Pass
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline" style="display: inline-block; margin-bottom: .5rem; margin-top: 15px;">
                                            <input type="radio" :name="item.admission_no" value="Fail" :v-model="item.result" @click="clickResult_Radio($event, 'Fail', item.admission_no)"/> Fail
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline" style="display: inline-block; margin-bottom: .5rem; margin-top: 15px;">
                                            <input type="radio" :name="item.student_name" checked value="Continue" :v-model="item.nextsessionstatus" @click="clickNSession_Radio($event, 'Continue', item.admission_no)"/> Continue
                                        </label>
                                    </td>
                                    <td>
                                        <label class="radio-inline" style="display: inline-block; margin-bottom: .5rem; margin-top: 15px;">
                                            <input type="radio" :name="item.student_name" value="Leave" :v-model="item.nextsessionstatus" @click="clickNSession_Radio($event, 'Leave', item.admission_no)" /> Leave
                                        </label>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr />
                <div class="col-12">
                    <button class="save" @click="goPromote()" id="globalSave" style="margin:0 0 1rem;">Promote</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import message from "../Alertmessage/message.vue";
import Loading from "../LoadingController.vue";
export default {
    components: {
        Loading,
        message
    },
    data() {
        return {
            SearchStudObj: { "class_id": "", "section_id": ""},            
            ClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Class Section"}]}],
            SectionList: [{"id":0,"section":"Class Section"}],

            PromoteStudObj: { "promote_session": "", "class_id": "", "section_id": "", "promoteStudList": []},
            PromoteClassList: [{"id":0,"class":"Select Class","section":[{"id": 0, "section":"Select Section"}]}],
            PromoteSectionList: [{"id":0,"section":"Select Section"}],
            sessionList: [{"id":0,"session":"Select Session"}],
            class_sectionList: [],

            showStudRecord: false,
            PromoteObj: [
                {"id":"","admission_no": "", "student_name": "", "father_name": "", "dob": "", "result": "Pass", "nextsessionstatus": "Continue"}
            ],

            msg: {
                text: "",
                type: ""
            },
        }
    },
    created() {
        EventBus.$emit("ThemeClicked");
        this.getAllClass();
        this.getAllSession();
    },
    methods: {        
        getAllClass() {
            this.axios.get("/api/class").then(response => {
                let array = response.data.sort((a, b) => {
                    if (a.sectionid > b.sectionid) {
                        return 1;
                    }
                    if (a.sectionid < b.sectionid) {
                        return -1;
                    }
                    return 0;
                });

                this.class_sectionList = array;
                this.sortList(array);
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
            this.PromoteClassList = this.ClassList;
            this.SearchStudObj.class_id = this.ClassList[0].id;
            this.SearchStudObj.section_id = this.SectionList[0].id;

            this.PromoteStudObj.class_id = this.PromoteClassList[0].id;
            this.PromoteStudObj.section_id = this.PromoteSectionList[0].id;
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
            this.SearchStudObj.section_id = this.SectionList[0].id;            
            if(this.SearchStudObj.class_id == 0)
            {
                $('#classid').css('border', '1px solid red');
            }
            else
            {
                $('#classmsg').css('display', 'none');
                $('#classid').css('border', '1px solid #d2d6de');
            }
            this.showStudRecord = false;
        },

        changeSection(aId)
        {            
            if(aId == 0)   $('#sectionid').css('border', '1px solid red');
            else
            {
                $('#sectionmsg').css('display', 'none');        
                $('#sectionid').css('border', '1px solid #d2d6de');
            }
            this.showStudRecord = false;
        },

        checkSearchValidate()
        {
            var returnValue = true;
            if(this.SearchStudObj.class_id == "" || this.SearchStudObj.class_id == undefined || this.SearchStudObj.class_id == 0)
            {
                $('#classmsg').css('display', 'block');
                $('#classid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.SearchStudObj.section_id == "" || this.SearchStudObj.section_id == undefined || this.SearchStudObj.section_id == 0)
            {
                $('#sectionmsg').css('display', 'block');
                $('#sectionid').css('border', '1px solid red');
                returnValue = false;
            }            
            return returnValue;
        },

        goSearch(){
            if(this.checkSearchValidate()){
                this.showStudRecord = true;
                EventBus.$emit("ThemeClicked");
                var class_section_id = '';
                for(let i=0; i<this.class_sectionList.length; i++){
                    
                    if(this.class_sectionList[i].classid == this.SearchStudObj.class_id && this.class_sectionList[i].sectionid == this.SearchStudObj.section_id){
                        class_section_id = this.class_sectionList[i].class_section_id;
                        break;
                    }
                }
                this.PromoteObj = [];
                this.axios.get(`/api/student/sibling/${class_section_id}`).then(response => {                    
                    for(let s=0; s<response.data.length; s++){
                        this.PromoteObj.push({"id": response.data[s].id,"admission_no": response.data[s].admission_no, "student_name": response.data[s].name, "father_name": response.data[s].father_name, "dob": response.data[s].dob, "result": "Pass", "nextsessionstatus": "Continue"});
                    }                 
                });                
            }            
        },

        getAllSession() {
            this.sessionList = [{"id":0,"session":"Select Session"}];
            this.axios.get("/api/academicyr").then(response => {                        
                for(let i=0; i<response.data.length; i++){
                    if(response.data[i].is_active != 'delete'){
                        this.sessionList.push(response.data[i]);
                    }
                }
                this.PromoteStudObj.promote_session = this.sessionList[0].id;
                // console.log(JSON.stringify(this.sessionList));
            });
        },

        changePromoteClass(aId){
            this.PromoteSectionList = [];
            this.PromoteSectionList = [{"id":0,"section":"Class Section"}];
            if(aId != 0)
            {
                for(let i=0; i<this.PromoteClassList.length;i++){
                    if(this.PromoteClassList[i].id == aId){
                        for(let a=0; a<this.PromoteClassList[i].section.length; a++){
                            this.PromoteSectionList.push(this.PromoteClassList[i].section[a]);
                        }
                        break;
                    }
                }
            }
            this.PromoteStudObj.section_id = this.PromoteSectionList[0].id;            
            if(this.PromoteStudObj.class_id == 0)
            {
                $('#promoteclassid').css('border', '1px solid red');
            }
            else
            {
                $('#promoteclassmsg').css('display', 'none');
                $('#promoteclassid').css('border', '1px solid #d2d6de');
            }
        },

        changePromoteSection(aId)
        {            
            if(aId == 0)   $('#promotesectionid').css('border', '1px solid red');
            else
            {
                $('#promotesectionmsg').css('display', 'none');        
                $('#promotesectionid').css('border', '1px solid #d2d6de');
            }
        },

        changePromoteSession(aId){
            if(aId == 0)   $('#promotesessionid').css('border', '1px solid red');
            else
            {
                $('#promotesessionmsg').css('display', 'none');        
                $('#promotesessionid').css('border', '1px solid #d2d6de');
            }
        },

        checkPromoteValidate()
        {
            var returnValue = true;
            if(this.PromoteStudObj.promote_session == "" || this.PromoteStudObj.promote_session == undefined || this.PromoteStudObj.promote_session == 0)
            {
                $('#promotesessionmsg').css('display', 'block');
                $('#promotesessionid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.PromoteStudObj.class_id == "" || this.PromoteStudObj.class_id == undefined || this.PromoteStudObj.class_id == 0)
            {
                $('#promoteclassmsg').css('display', 'block');
                $('#promoteclassid').css('border', '1px solid red');
                returnValue = false;
            }
            if(this.PromoteStudObj.section_id == "" || this.PromoteStudObj.section_id == undefined || this.PromoteStudObj.section_id == 0)
            {
                $('#promotesectionmsg').css('display', 'block');
                $('#promotesectionid').css('border', '1px solid red');
                returnValue = false;
            }
            return returnValue;
        },

        clickResult_Radio(e, aResult, aAdmissionNo){
            if(e.target.checked){
                for(let p=0; p<this.PromoteObj.length; p++){
                    if(this.PromoteObj[p].admission_no == aAdmissionNo){
                        this.PromoteObj[p].result = aResult;
                        break;
                    }
                }
            }
        },

        clickNSession_Radio(e, aNextSessionStatus, aAdmissionNo){
            if(e.target.checked){
                for(let p=0; p<this.PromoteObj.length; p++){
                    if(this.PromoteObj[p].admission_no == aAdmissionNo){
                        this.PromoteObj[p].nextsessionstatus = aNextSessionStatus;
                        break;
                    }
                }
            }
        },

        goPromote(){
            if(this.checkPromoteValidate()){                
                this.PromoteStudObj.promoteStudList = this.PromoteObj;
                console.log("Result >>>"+JSON.stringify(this.PromoteStudObj));                
            }            
        }
    }
}
</script>