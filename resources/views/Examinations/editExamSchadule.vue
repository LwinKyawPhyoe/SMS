<template>
     <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Examinations</h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home </router-link> > <router-link to="/examschadule" class="home">Exam Schedule</router-link> > Add Examinations
            </h4>
        </div>
        <hr>
        <div class="card" v-if="this.display == true">
            <div class="card-header">
                <h6>Reuse Exam</h6>
            </div>
            <div class="card-body">
                <div class="row" id="row">
                    <div class="col-lg-4 col-md-4 col-12 textbox">
                        <label >Exam name: <strong>*</strong> </label>
                        <select class="inputbox" @change="getExamId($event)">
                            <option >Select</option>
                            <option :value="Exams.id" v-for="Exams in exams" :key="Exams.id">{{Exams.name}}</option>
                        </select>
                    </div>
                    <div class="table-responsive" style="margin-top:23px;">
                    <table class="table table-hover table-striped">
                                <thead>
                                    <th nowrap>Subject</th>
                                    <th nowrap>Date</th>
                                    <th nowrap>Start Time</th>
                                    <th nowrap>End Time</th>
                                    <th nowrap>Room</th>
                                    <th nowrap>Full Marks</th>
                                    <th nowrap>Passing Marks</th>
                                </thead>
                                <tbody>
                                    <tr v-for="n in mainExamSubjects" :key="n.id">
                                    <td >{{n.subject}}</td>
                                    <td><input type="date" v-model="n.date"></td>
                                    <td><input type="time" v-model="n.start_time"></td>
                                    <td><input type="time" v-model="n.end_time"></td>
                                    <td><input class="inputbox" type="text" v-model="n.room"/></td>
                                    <td><input class="inputbox" type="text" v-model="n.full_marks"/></td>
                                    <td><input class="inputbox" type="text" v-model="n.passing_marks"/></td>
                                    </tr>
                                </tbody>
                    </table>
                </div>
                <div style="width: 100%;">
                    <button class="save" style="margin:10px 1rem 1rem 0px" type="button" @click="updateExamSchadule()"><router-link to="examschadule" style="color:white" class="submit">Update</router-link></button>
                </div>
                </div>
            </div>
        </div>
        <!-- <button type="button" @click="updateExamSchadule()">Test</button> -->
     </div>
</template>

<script>
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
 
  export default {
    components: { DatePicker },
    data() {
      return {
        exams: [],
        id1:'',
        id2:'',
        id3:'',
        academicYearId:'',
        Sections:[],
        Class:[],
        arrayClassSectionExam:[],
        Subjects:[],
        check1 : null,
        check2 : null,
        SubjectName:[],
        SubjectNameS:[],
        mainExamSubjects:[],
        SaveExamSchadule:{examSchaduleObj:[]},
        message:'',
        display : false,
        data : false,
        newExamId : '',
        alertMessage:''
      };
    },created(){
        this.id1 = this.$route.params.exam_id;
        this.id2 = this.$route.params.class_id;
        this.id3 = this.$route.params.section_id;
        this.Search();
        this.getExamName();
        this.getClass();
        this.getSection();
        setTimeout(() => {
            this.display = true;
        }, 1300);
    },methods:{
        getClass(){
      this.axios
        .get(`/api/getClasses`)
        .then(response => {            
            this.Class = response.data;
        });
    },
        getExamName(){
            this.axios
                .get('/api/ExamList')
                .then(response => {
                    this.exams = response.data;
                });
        },getSectionId(eventS){
      this.id3 = eventS.target.value;
      console.log(this.id1 + this.id2 + this.id3);
    },getExamId(event){
            this.newExamId=event.target.value;
        },getClassId(event){
            this.id2 = event.target.value;
        }
        ,Search(){
        this.mainExamSubjects = [];
        this.arrayClassSectionExam.push(this.id1);
        this.arrayClassSectionExam.push(this.id2);
        this.arrayClassSectionExam.push(this.id3);
        this.axios
        .get(`/api/searchExamSchadule/${this.arrayClassSectionExam}`)
        .then(response=>{
            // this.Subjects = response.data;
            this.mainExamSubjects = response.data;
            this.arrayClassSectionExam = [];
        })
        ;
        
        setTimeout(() => {
            var dataValue ;
            for(var i = 0;i<this.mainExamSubjects.length;i++){
                dataValue = this.mainExamSubjects[i].subject;
            }
            if(dataValue == undefined){
                this.data = false;
            }else{
                this.data = true;
            }

            this.display = true;
        }, 500);
        
    },
    allData(){
        for(var i = 0;i<this.mainExamSubjects.length;i++){
            this.SaveExamSchadule.examSchaduleObj.push({'session_id':'','exam_id':this.newExamId,'assign_subject_id':this.mainExamSubjects[i].id,
            'date_of_exam':this.mainExamSubjects[i].date,'start_time':this.mainExamSubjects[i].start_time,'end_time':this.mainExamSubjects[i].end_time,
            'room_no':this.mainExamSubjects[i].room,'full_marks':this.mainExamSubjects[i].full_marks,'passing_marks':this.mainExamSubjects[i].passing_marks,
            'note':'no','is_active':'yes','domain':'TS'
            });
        }
    },allData1(){
        for(var i = 0;i<this.mainExamSubjects.length;i++){
            this.SaveExamSchadule.examSchaduleObj.push({'session_id':'','exam_id':this.id1,'assign_subject_id':this.mainExamSubjects[i].id,
            'date_of_exam':this.mainExamSubjects[i].date,'start_time':this.mainExamSubjects[i].start_time,'end_time':this.mainExamSubjects[i].end_time,
            'room_no':this.mainExamSubjects[i].room,'full_marks':this.mainExamSubjects[i].full_marks,'passing_marks':this.mainExamSubjects[i].passing_marks,
            'note':'no','is_active':'yes','domain':'TS'
            });
        }
    }
    ,getSection(){
        this.axios.get(`/api/getSections`)
        .then(response=>{
            this.Sections = response.data;
        });
    },updateExamSchadule(){
        if(this.newExamId == ''){
            this.allData1();
        this.axios.post(`/api/examSchadules/addExamSchadule`,this.SaveExamSchadule).then(response=>{
        this.alertMessage = response.data;
        })
        }else{
        this.allData();
        this.axios.post(`/api/examSchadules/updateExamSchadule/${this.id1}`,this.SaveExamSchadule).then(
        response=>{
            this.alertMessage = response.data;
        }
        )
        }
    }
    }
  };
</script>