<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Laravel New CRUD</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .bg-light {
            background-color: #eae9e9 !important;
        }
    </style>    
</head>
<body>
<div id="app">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
<script>
// Change SideBar
function changeBar() {
        if(document.getElementById('bar').style.marginLeft == '5.5rem') {
            document.getElementById('bar').style.marginLeft = '15.5rem';
            document.getElementById('bigBar').style.display = 'block';
            document.getElementById('list').style.display = 'block';
            document.getElementById('smallBar').style.display = 'none';
        } else {
            document.getElementById('bar').style.marginLeft = '5.5rem';
            document.getElementById('bigBar').style.display = 'none';
            document.getElementById('list').style.display = 'none';
            document.getElementById('smallBar').style.display = 'block';
        }
}
function showForm() {
    if (document.getElementById('bigBar').style.display == 'none') {
        document.getElementById('bar').style.marginLeft = '5.5rem';
    } else {
        document.getElementById('bar').style.marginLeft = '15.5rem';
    }
}

// Thein Gyi Mobile SideBar
function openAcademicC(id,item1,item2,item3,item4,item5,item6,item7,item8,time,long,itime,etime){
    var check;
    if(this.check){
        document.getElementById(id).style.height="0";
        document.getElementById(id).style.transition=itime;
        document.getElementById(item1).style.display="none";
        document.getElementById(item2).style.display="none";
        document.getElementById(item3).style.display="none";
        document.getElementById(item4).style.display="none";
        document.getElementById(item5).style.display="none";
        document.getElementById(item6).style.display="none";
        document.getElementById(item7).style.display="none";
        document.getElementById(item8).style.display="none";
        this.check=null;
    }else {
        document.getElementById(id).style.height=long;
        document.getElementById(id).style.transition=etime;
        setTimeout(() => {
        document.getElementById(item1).style.display="block";
        document.getElementById(item2).style.display="block";
        document.getElementById(item3).style.display="block";
        document.getElementById(item4).style.display="block";
        document.getElementById(item5).style.display="block";
        document.getElementById(item6).style.display="block";
        document.getElementById(item7).style.display="block";
        document.getElementById(item8).style.display="block";
        }, time);
        this.check=true;
    }
}

// Student Tab Background
function toggleBtn(btn1,btn2,btn3,btn4){
        document.getElementById(btn1).style.backgroundColor = "white";
        document.getElementById(btn1).style.color = "Black";
        document.getElementById(btn2).style.backgroundColor = "#1b5e20";
        document.getElementById(btn2).style.color = "white";
        document.getElementById(btn3).style.backgroundColor = "#1b5e20";
        document.getElementById(btn3).style.color = "white";
        document.getElementById(btn4).style.backgroundColor = "#1b5e20";
        document.getElementById(btn4).style.color = "white";
}
function changeMega(btn1,btn2){
    document.getElementById(btn1).style.backgroundColor = "white";
    document.getElementById(btn1).style.color = "Black";
    document.getElementById(btn2).style.backgroundColor = "#1b5e20";
    document.getElementById(btn2).style.color = "white";
}

// SideBar Background
$('.additional-menu a').on('click',function() {
    var t = $(this);
    t.parents('.additional-menu').find('li').removeClass('active');
    t.parentsUntil('.additional-menu','li').addClass('active');
})

// For Popover Table
function showColumns(id,idBg) {
    document.getElementById(id).style.display = "block";
    document.getElementById(idBg).style.display = "block";
    this.checkColumns = true;
    document.getElementById(idBg).style.position = "fixed";
}

function clickBackground(id,idBg){
    document.getElementById(id).style.display = "none";
    document.getElementById(idBg).style.display = "none";
    this.checkColumns = false;
}

function showTableHeader(data){
    if (document.getElementById(data.Id).style.background == "rgb(213, 220, 215)") {
        document.getElementById(data.Id).style.background = "#1b5e20";
        document.getElementById(data.Id).style.color = "white";
        var all_col=document.getElementsByClassName(data.class);
        for(var i=0;i<all_col.length;i++){
            all_col[i].style.display="table-cell";
        }
    } else {
        document.getElementById(data.Id).style.background = "rgb(213, 220, 215)";
        document.getElementById(data.Id).style.color = "black";
        var all_col=document.getElementsByClassName(data.class);
        for(var i=0;i<all_col.length;i++){
            all_col[i].style.display="none";
        }
    }
}

function clickShowAllColumn(data){
    for(let i = 0; i < data.length;i++){
        document.getElementById(data[i].Id).style.background = "#1b5e20";
        document.getElementById(data[i].Id).style.color = "white";
        var all_col=document.getElementsByClassName(data[i].class);
        for(var a = 0;a<all_col.length;a++){
            all_col[a].style.display="table-cell";
        }
    }
}

</script>