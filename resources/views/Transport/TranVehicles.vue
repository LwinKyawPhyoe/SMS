<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">Transport</h2>
            <h4 class="stuLink">
                <router-link class="home" to="/dashboard">Home</router-link>> Vehicles
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;"/>

        <Loading></Loading>
        <confirm :url="props"></confirm>
        <div class="row" style="align-items: end !important;margin: 0px">
            <div class="col-lg-5 col-md-12" style="padding: 0px;">
                <div class="card">
                    <div class="card-header">
                        <h6>Add Vehicle</h6>
                    </div>
                    <div class="card-body" style="padding:1rem 0;border-bottom: 1px solid #8080808c;">
                        <message :alertmessage="msg" id="alertmsg"/>

                        <form @submit.prevent="goSave">
                            <div class="col-12">
                                <label for="number">Vehicle Number <strong>*</strong></label>
                                <input type="text" id="vehicle_number" class="inputbox" v-model="tranVehicle.vehicle_no" 
                                    @keyup="onValidate(tranVehicle.vehicle_no, 'vehicle_number', 'vehicle_number_msg')" 
                                    v-on:blur="onValidate(tranVehicle.vehicle_no, 'vehicle_number', 'vehicle_number_msg')"/>
                                <span id="vehicle_number_msg" class="error_message">Vehicle number is required</span>
                            </div>
                            <div class="col-12">
                                <label for="model">Vehicle Model</label>
                                <input type="text" class="inputbox" v-model="tranVehicle.vehicle_model" />
                            </div>
                            <div class="col-12">
                                <label for="name">Driver Name</label>
                                <input type="text" class="inputbox" v-model="tranVehicle.driver_name" />
                            </div>
                            <div class="col-12">
                                <label for="licence">Driver Licence</label>
                                <input type="text" class="inputbox" v-model="tranVehicle.driver_licence" />
                            </div>
                            <div class="col-12">
                                <label for="contact">Driver Contact</label>
                                <input type="text" class="inputbox" v-model="tranVehicle.driver_contact" 
                                    @keydown="restrictPhoneNo($event, tranVehicle.driver_contact)"/>
                            </div>
                            <div class="col-12 end">
                                <label for="note">Note</label>
                                <textarea class="textareas" style="font-size: 9.5pt;" rows="2" v-model="tranVehicle.note"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="save" id="globalSave">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 div_very_small" style="padding: 0;padding-left:15px;">
                <div class="card">
                    <div class="card-header">
                        <h6>Route List</h6>
                    </div>
                    <div class="card-body">
                        <message :alertmessage="deletemsg" id="delalertmsg"/>

                        <input type="text" placeholder="Search..." class="searchText" />
                        <div class="copyRows">
                            <div class="row" id="copyRow">                
                                <div class="col-3">
                                    <a href="#" @click.prevent="downloadExcel('studenttable', 'name', 'Tran_Vehicles.xls')" title="Excel">
                                        <i class="fa fa-file-excel-o"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="#" @click.prevent="printme('print')" title="Print">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a title="Columns" @click="showColumns()">
                                        <i class="fa fa-columns"></i>
                                    </a>
                                    <div id="columns" class="columns">
                                       <div v-for="item in arrayTableColumns">
                                            <p @click="showTableHeader(item)" :id="item.Id" class="tableLink">
                                                <span>{{item.Name}}</span>
                                            </p> 
                                        </div>
                                        <div>
                                            <p @click="clickShowAllColumn(arrayTableColumns)" class="tableLinkActive">
                                                <span>Restore visibility</span>
                                            </p>
                                        </div> 
                                    </div>
                                    <div @click="clickBackground()" id="backgroundColumn" class="column_background"></div>
                                </div>
                            </div>
                        </div>
                        <h1 class="NoData" v-if="vehicleList.length==0">No Data</h1>
                        <div class="table-responsive" id="print">
                            <table class="table table-hover table-striped" id="studenttable" v-if="vehicleList.length!=0">
                                <thead>
                                    <tr>
                                        <th :class="arrayTableColumns[0].class" nowrap>Vehicle Number</th>
                                        <th :class="arrayTableColumns[1].class" nowrap>Vehicle Model</th>
                                        <th :class="arrayTableColumns[2].class" nowrap>Driver Name</th>
                                        <th :class="arrayTableColumns[3].class" nowrap>Driver License</th>
                                        <th :class="arrayTableColumns[4].class" nowrap>Driver Contact</th>
                                        <th :class="arrayTableColumns[5].class" style="text-align:right;" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="vehicle in vehicleList" :key="vehicle.id" class="active">
                                        <td :class="arrayTableColumns[0].class" nowrap>{{vehicle.vehicle_no}}</td>
                                        <td :class="arrayTableColumns[1].class" nowrap>{{vehicle.vehicle_model}}</td>
                                        <td :class="arrayTableColumns[2].class" nowrap>{{vehicle.driver_name}}</td>
                                        <td :class="arrayTableColumns[3].class" nowrap>{{vehicle.driver_licence}}</td>
                                        <td :class="arrayTableColumns[4].class" nowrap>{{vehicle.driver_contact}}</td>
                                        <td :class="arrayTableColumns[5].class" style="text-align:right;">
                                            <i @click="goEdit(vehicle.id)" class="fa fa-pencil pen">
                                                <span class="penLabel">Edit</span>
                                            </i>
                                            <i @click="goDelete(vehicle.id)" data-toggle="modal" data-target="#exampleModalCenter" class="fa fa-trash time">
                                                <span class="timeLabel">Delete</span>
                                            </i>
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
import message from "../Alertmessage/message.vue";
import confirm from "../message/confirm.vue";
import { EventBus } from "../../js/event-bus.js"
import {Util} from '../../js/util';
import Loading from "../LoadingController.vue";

export default {
    components: {
        confirm,
        message,
        Loading
    },
    data() 
    {
        return {
            arrayTableColumns: [
                {"Name": "Vehicle Number","Id": "Vehicle_Number_Id", "class": "tbl_body_Number"},
                {"Name": "Vehicle Model","Id": "Vehicle_Model_Id", "class": "tbl_body_Model"},
                {"Name": "Driver Name","Id": "Driver_Name_Id", "class": "tbl_body_Name"},
                {"Name": "Driver License","Id": "Driver_License_Id", "class": "tbl_body_License"},
                {"Name": "Driver Contact","Id": "Driver_Contact_Id", "class": "tbl_body_Contact"},
                {"Name": "Action","Id": "Action_Id", "class": "tbl_body_Action"},
            ],
            tranVehicle: {},
            vehicleList: [],
            props: {
                url: "",
                type: ""
            },
            msg: {
                text: "",
                type: ""
            },
            deletemsg: {
                text: "",
                type: ""
            }
        };
    },

    mounted() {
        EventBus.$emit("onLoad");
    },

    created() 
    {
        EventBus.$emit("ThemeClicked");
        EventBus.$on("clicked", response => {            
            this.deletemsg.text = response.text;
            this.deletemsg.type = response.type;
            Util.workAlert('#delalertmsg');
            this.getVehicleList();
        });
        this.getVehicleList();
    },

    methods: 
    {
        getVehicleList()
        {
            EventBus.$emit("onLoad");
            this.axios.get('/api/tranVehicleList').then(response => {
                this.clickShowAllColumn(this.arrayTableColumns);            
                this.vehicleList = response.data;
                EventBus.$emit("onLoadEnd");
            });
        },

        goSave() 
        {
            if(this.checkValidate())
            {
                this.axios.post('/api/TranVehicle/save', this.tranVehicle).then(response => {
                    if(response.data.type == "success"){
                        this.tranVehicle = {"id":"","vehicle_no":"","vehicle_mocel":"","driver_name":"","driver_licence":"","driver_contact":"","note":""};
                        this.getVehicleList();
                    }
                    this.msg.text = response.data.text;
                    this.msg.type = response.data.type;
                    Util.workAlert('#alertmsg');
                })
                .catch(error => {            
                    console.log("err->" + JSON.stringify(this.error.response))
                });
            }
        },

        goEdit(aId)
        {      
            this.axios.get(`/api/TranVehicle/edit/${aId}`).then(response => {
                this.tranVehicle = response.data;
            });
        },

        goDelete(aID)
        {
            var funName = "delete"; /**Delete function */
            this.props.type = "delete";
            this.props.url = `TranVehicle/${funName}/${aID}`;
        },

        onValidate(value, inputId, megId)
        {
            Util.onValidate(value, inputId, megId);
        },

        checkValidate()
        {
            if(this.tranVehicle.vehicle_no == "" || this.tranVehicle.vehicle_no == undefined)
            {
                Util.onValidateMessage('vehicle_number', 'vehicle_number_msg');
            }
            else
            {
                return true;
            }

            return false;
        },

        restrictPhoneNo(event, value)
        {
            Util.restrictPhoneNo(event, value);
        },

        printme(table)
        {
            Util.printme(table);
        },

        downloadExcel(table, name, filename) 
        {
            Util.downloadExcel(table,name,filename);
        },
        // Column Hide 
        showColumns(){
            Util.showColumns('columns','backgroundColumn');
        },
        clickBackground(){
            Util.clickBackground('columns','backgroundColumn');
        },
        showTableHeader(data){
            Util.showTableHeader(data);
        },
        clickShowAllColumn(data){
            Util.clickShowAllColumn(data);
        },
    }
};
</script>