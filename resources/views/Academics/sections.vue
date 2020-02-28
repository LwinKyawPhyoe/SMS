<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                Academics
            </h2>
            <h4 class="stuLink">
                <router-link to="/home" class="home">Home</router-link> > Sections
            </h4>
        </div>
        <hr>

        <div class="row" style="align-items: end !important;">
            <div class="col-lg-5 col-md-12" style="padding-left:2px;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Section</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg"/>
                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="section">Section Name<strong>*</strong></label>
                                <input id="sectionid" type="text" class="inputbox" v-model="SectionObj.section"
                                    @keyup="onValidate(SectionObj.section, 'sectionid', 'sectionmsg')" 
                                    v-on:blur="onValidate(SectionObj.section, 'sectionid', 'sectionmsg')"/>
                                <span id="sectionmsg" class="error_message">Section Name is required</span>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12" style="padding-left:0;">
                <div class="card">
                    <div class="card-header">
                        <h6>Section List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg"/>                        
                        <input
                            v-on:keyup="searchTable()"
                            id="myInput"
                            type="text"
                            placeholder="Search..."
                            class="searchText"
                        />
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                <a href="#" title="Excel">
                                    <i class="fa fa-file-excel-o"></i>
                                </a>
                                </div>
                                <div class="col-3">
                                <a href="#" title="Print">
                                    <i class="fa fa-print"></i>
                                </a>
                                </div>
                                <div class="col-3">
                                <a href="#" title="Columns">
                                    <i class="fa fa-columns"></i>
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">            
                            <table class="table table-hover table-striped" id="studenttable">
                                <thead>
                                    <tr>
                                        <th class="all" nowrap>Section</th>                                        
                                        <th class="all" style="text-align: right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr v-for="section in SectionList" :key="section.id" class="active">
                                        <td class="all" nowrap>{{section.section}}</td>
                                        <td style="text-align: right;">
                                            <i @click="goEdit(section.id)" class="fa fa-pencil pen"></i>
                                            <i @click="goDelete(section.id)" class="fa fa-trash time"></i>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import message from '../Alertmessage/message.vue';
export default {
    components: {
        message    
    },
    data() {
        return {
            SectionObj: {},
            SectionList: [],
            msg: {
                text: "",
                type: ""
            },
            deletemsg: {
                text: "",
                type: ""        
            },      
        };
    },
    created() {
        this.getAllSection();
    },
    methods: {
        getAllSection(){
        this.axios
            .get('/api/section')
            .then(response => {            
                this.SectionList = response.data;
            });
        },

        onValidate(value, inputId, megId)
        {
            if(value == "" || value == undefined) document.getElementById(inputId).style.border = 'solid 1px red';
            else 
            {
                document.getElementById(inputId).style.border = 'solid 1px #d2d6de';
                document.getElementById(megId).style.display = 'none';
            }
        },

        onValidateMessage(inputId, megId)
        {
            document.getElementById(inputId).style.border = 'solid 1px red';
            document.getElementById(megId).style.display = 'block';            
        },

        checkValidate()
        {
            if(this.SectionObj.section == "" || this.SectionObj.section == undefined)
            {
                this.onValidateMessage('sectionid', 'sectionmsg');
                return false;
            }
            else
            {
                return true;
            }
            return false;
        },

        goSave() {
            if(this.checkValidate())
            {
                this.axios
                    .post('/api/Section/save', this.SectionObj)
                    .then(response => (                        
                        this.SectionObj = {"id":"","section":"","created_at":"","updated_at":""},
                        this.getAllSection(),
                        this.msg.text = response.data.text,
                        this.msg.type = response.data.type
                    ))
                    .catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response))
                    });
            }      
        },

        goAlertClose(){
            $('.alert').css('display', 'none')
        },

        goEdit(aId){      
            this.axios
                .get(`/api/Section/edit/${aId}`)
                .then(response => {                        
                    this.SectionObj = response.data[0];
                    console.log("---->" + JSON.stringify(this.SectionObj))
                });
        },

        goDelete(aID){
            this.axios
                .get(`/api/Section/delete/${aID}`)
                .then(response => {            
                    console.log("-->" + JSON.stringify(response.data));
                    let i = this.SectionList.map(item => item.id).indexOf(aID);
                    this.SectionList.splice(i, 1),            
                    this.deletemsg.text = response.data.text,
                    this.deletemsg.type = response.data.type
                });
        },

        searchTable() {
            var input, filter, found, table, tr, td, i, j;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    [i].style.display = "none";
                }
            }
        }
    }
};
</script>