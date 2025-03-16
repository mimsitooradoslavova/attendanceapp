/*I will need this templet many times ahead
$.ajax({
      $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{},
        beforeSend:function(e){

        },
        success:function(rv){

        },
        error:function(e){

        },

    });
*/ 

function getSessionHTML(rv){
    let x=``;
    x=`<option value=-1>SELECT ONE</option>`
    let i=0;
    for(i=0;i<rv.length;i++){
        let cs=rv[i];
        x=x+`<option value=${cs['id']}>${cs['year']+" "+cs['term']}</option>`;
        }
    return x;
}
function loadSession(){
    //make an ajax call and load the session from DB
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{action:"getSession"},
        beforeSend:function(e){

        },
        success:function(rv){
           // alert(JSON.stringify(rv));
           //lets create the HTML from rv dynamically
           let x=getSessionHTML(rv);
           $("#ddlclass").html(x);
        },
        error:function(e){
            alert("OOPS!");
        },

    });
}
function getCourseCardHTML(classlist){
    let x=``;
            x=``;
            let i=0;
            for(i=0;i<classlist.length;i++){
                let cc=classlist[i];
                x=x+`<div class="classcard" data-classobject='${JSON.stringify(cc)}'>${cc['code']}</div>`;
            }
    return x;
}
function fetchFacultyCourses(facid,sessionid){
    //get all the courses taken by the loged in faculty
    //for the selected session
    //from DB
    //by an ajax call
    $.ajax({
          url:"ajaxhandler/attendanceAJAX.php",
          type:"POST",
          dataType:"json",
          data:{facid:facid,sessionid:sessionid,action:"getFacultyCourses"},
          beforeSend:function(e){
  
          },
          success:function(rv){
            //alert(JSON.stringify(rv));
            let x=getCourseCardHTML(rv);
            $("#classlistarea").html(x);
          },
          error:function(e){
  
          },
  
      });
    }

function getClassdetailsAreaHTML(classobject){
        let x=`<div class="classdetails">
                <div class="code-area">${classobject['code']}</div>
                <div class="title-area">${classobject['title']}</div>
                <div class="ondate-area">
                    <input type="date">
                </div>
            </div>`;
        return x;
    }

function  fetchStudentList(sessionid,classid){
    //make an ajax call and get the data from DB
    $.ajax({
        url:"ajaxhandler/attendanceAJAX.php",
        type:"POST",
        dataType:"json",
        data:{sessionid:sessionid,classid:classid,action:"getStudentList"},
        beforeSend:function(e){

        },
        success:function(rv){

        },
        error:function(e){

        },
    });
}
//as soon as the page is done loading do the following
$(function(e)
{
    $(document).on("click","#btnLogout", function(ee){
            $.ajax(
                {
                    url:"ajaxhandler/logoutAjax.php",
                    type:"POST",
                    dataType:"json",
                    data:{id:1},
                    beforeSend:function(e){
                        
                    },
                    success:function(e){
                        document.location.replace("login.php");
                    },
                    error:function(e){
                       alert("Something went wrong!"); 
                    }
                });
    });
    loadSession();
    $(document).on("change","#ddlclass",function(e){
        let si=$("#ddlclass").val();
        if(si!=-1){
            //alert(si);
            let sessionid=si;
            let facid=$("#hiddenFacId").val();
            fetchFacultyCourses(facid,sessionid);
        }
    });
    $(document).on("click",".classcard",function(e){
        //what is the underlyning object?
        let classobject=$(this).data('classobject');
        //alert(JSON.stringify(s));
        let x=getClassdetailsAreaHTML(classobject);
        $("#classdetailsarea").html(x);
        //now fill the studentlist
        //for session and course
        let sessionid=$("#ddlsession").val();
        let classid=classobject['id'];
        if(sessionid!=-1){
            fetchStudentList(sessionid,classid);

        }  
        
    });
});