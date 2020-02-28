<template>
    <div class="form" id="bar">
        <div class="toplink">
            <h2 class="stuName">
                Academics
            </h2>
            <h4 class="stuLink">
                <a href="" style="text-decoration:none;color:#1b5e20;">Home </a> > Assign Subjects
            </h4>
        </div>
        <hr style="margin-bottom: -0.5rem;">

        <div class="card">
            <div class="card-header">
                <h6>Select Criteria</h6>                
                <router-link to="/asssubjects" onclick="showForm()" class="add">
                    Add
                </router-link>
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
        </div>

        <div class="card">
            <div class="card-header">
                <h6>Assign Subject</h6>                
            </div>
            <div class="card-body">
                <div v-for="filter in filterList" class="row" id="row" style="margin: 0px;">
                    <div class="col-lg-6 col-12 textbox">
                        <div class="col-lg-3 col-12" style="display: inline-block;padding: 0px;margin: 0px;">
                            <label for="name" class="title">{{ filter.firstcaption }}</label>
                        </div>
                        <div class="col-lg-7 col-12" style="display: inline-block;padding: 0px;margin: 0px;">
                            <select class="inputbox" name="class" disabled>
                                <option selected>{{ filter.firstvalue }}</option>                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 textbox">
                        <div class="col-lg-3 col-12" style="display: inline-block;padding: 0px;margin: 0px;">
                            <label for="name" class="title">{{ filter.secondcaption }}</label>
                        </div>
                        <div class="col-lg-7 col-12" style="display: inline-block;padding: 0px;margin: 0px;">
                            <select class="inputbox" name="class" disabled>
                                <option selected>{{ filter.secondvalue }}</option>
                            </select>
                        </div>
                    </div>
                </div>                               
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            filterList :
            [
                { "itemid": 1, "firstcaption": "Subject", "firstvalue": "first", "secondcaption": "Teacher", "secondvalue": "second" },
                { "itemid": 2, "firstcaption": "Subject", "firstvalue": "first", "secondcaption": "Teacher", "secondvalue": "second" },
                { "itemid": 3, "firstcaption": "Subject", "firstvalue": "first", "secondcaption": "Teacher", "secondvalue": "second" },
                { "itemid": 4, "firstcaption": "Subject", "firstvalue": "first", "secondcaption": "Teacher", "secondvalue": "second" }
            ]
        }
    },
    methods:{    
    }
};
</script>