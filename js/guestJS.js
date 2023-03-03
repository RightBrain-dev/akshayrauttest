$(document).ready(function(){

    getUserList();
    function getUserList()
    {
        var data = {name: 'getList',params:{}};
        var json = JSON.stringify(data);
        $.ajax({
            url:apiBaseUrl,
            type:"POST",
            data:json,
            contentType: "application/json",
            dataType: "json", 
            success: function(data){
                $("#item1").empty();
                var item1 = document.getElementById('item1');
                var users = data.response.result;
                addChild(item1,users);
            },
            error:function(error){
                console.log(error)
            }
        });
    }
    function addChild(parent,data)
    {
        var ul = document.createElement('ul');
        parent.appendChild(ul);
        for (var i = 0; i < data.length; i++) {
            var li = document.createElement('li');
            li.textContent = data[i].name;
            ul.appendChild(li);
            
            if (data[i].children.length > 0) {
                addChild(li, data[i].children);
            }
        }
    }

    $("#myBtn").click(function(){
        $("#myModal").modal('show');
        $("#NameHelp").html('');

        var data = {name: 'getParentList',params:{}};
        var json = JSON.stringify(data);
        $.ajax({
            url:apiBaseUrl,
            type:"POST",
            data:json,
            contentType: "application/json",
            dataType: "json", 
            success: function(data){
                // $("#parentList").empty();  
                var plist = data.response.result;
                var options= "<option value='0' selected>By default it will be main parent</option>";
                $.each(plist, function(index, value) {
                    options+="<option value='"+value.id+"'>"+value.name+"</option>";
                  });
                  $("#parentList").html(options);
                //   console.log(options);
                // $("#item1").empty();
                // var item1 = document.getElementById('item1');
                // var users = data.response.result;
                // addChild(item1,users);
            },
            error:function(error){
                console.log(error)
            }
        });
      });

      $("#newMemberForm").submit(function(e){
        e.preventDefault();
        var parentId =  $('#parentList').val();
        var MemberName = $("#UserName").val();
        var regex = /^[a-zA-Z\s]*$/;
        $("#NameHelp").text("");
        if(MemberName =="")
        {
            $("#NameHelp").text("Please Enter Name");
            return false;
        }
        if (!regex.test(MemberName)) {
            $(this).val(MemberName.replace(/[^a-zA-Z\s]/g, '')); // Replace any non-character characters with empty string
            $("#NameHelp").text("Only Characters Allowed");
            return false;
        }
        var data = {name: 'saveMember',params:{
            "name":MemberName,
            "parentId":parentId
        }};
        // console.log(data);return;
        var json = JSON.stringify(data);
        $.ajax({
            url:apiBaseUrl,
            type:"POST",
            data:json,
            contentType: "application/json",
            dataType: "json", 
            beforeSend: function(request) {
                $("#saveMemberbtn").text("Saving ...");
                $("#saveMemberbtn").prop('disabled', true);
              },
            success: function(data){
                  var statuss= data.response.status;
                  if(statuss==200)
                  {
                      $("#myModal").modal('hide');
                      $("#UserName").val("");
                      $("#parentList").val("");
                      getUserList();
                  }
                setTimeout(function(){
                    $("#saveMemberbtn").text("Save");
                    $("#saveMemberbtn").prop('disabled', false);
                }, 3000);
            },
            error:function(error){
                setTimeout(function(){
                    $("#saveMemberbtn").text("Save");
                    $("#saveMemberbtn").prop('disabled', false);
                }, 3000);
            },
            
        });

      });
});