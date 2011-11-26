/**
 * Loading Chat Box
 */
function loadChatBox(){
    //  Chat Box Width
    var chatBoxWidth=250;
    //  Chat Box Maximum Height
    var chatBoxMaxHeight=400;
    //  Chat Box Minimum Height
    var chatBoxMinHeight=30;
    //  Friend Lists Hight
    var friendlistHeight=chatBoxMaxHeight-30;
    /**
     * Opening Chat Box on pageload
     */
    $("#divChatBox").dialog({
        
        /**
         *  Setting Height width parameteres for the Chat Box
         */
        minWidth:chatBoxWidth,
        width:chatBoxWidth,
        maxWidth:chatBoxWidth,
        minHeight:chatBoxMinHeight,
        height:chatBoxMaxHeight,
        maxHeight:chatBoxMaxHeight,
        resizable:false,
        /**
         * dis-allowing closing of chatbbox
         */
        closeOnEscape: false,
        open:function(event,ui){
            /**
             *  Replacing Close buttom with the minimize-maximize toggle button
             */
            $(".ui-dialog-titlebar-close").html($("<span></span>").addClass("ui-icon ui-icon-triangle-2-n-s"));
        },
        beforeclose:function(event,ui){
            /**
             *  Minimizing and Maximizing the Chat Box according to the situation(toggle)
             */
            var chatBox=$("div[aria-labelledby=ui-dialog-title-divChatBox]");
            if(chatBox.height()<=51){
                chatBox.animate({
                    minHeight:chatBoxMinHeight,
                    height:chatBoxMaxHeight
                });
            }else{
                chatBox.animate({
                    minHeight:chatBoxMinHeight+"px",
                    height:chatBoxMinHeight+"px"
                });
            }
            return false;
        }
    });
    
    
    /**
     * Giving green color to the Chat Box Header by removing the simple
     * ui-widget-header class and adding custom class "ui-widget-header-green"
     * class
     */
    var headerChatBox=$("#ui-dialog-title-divChatBox").parent();
    if(headerChatBox.hasClass("ui-widget-header")){
        headerChatBox.removeClass("ui-widget-header");
        headerChatBox.addClass("ui-widget-header-green");
    }
    
    
    /**
     * Load Friend Lists!
     */
    $.ajax({
        url:"friends.php",
        datatype:"json",
        cachr:false,
        success:function(msg){
            /*
             *  Store the Json String So that we can use it for searching purpose
             */
            $("#hidFriendList").val($.toJSON(msg));
            
            /**
             *  Creating UL-LI list to be appended to the Friendlist Chat
             */
            var divFriendList=$("<div></div>");
            divFriendList.attr("id","divFriendList");
            divFriendList.css({
                width:(chatBoxWidth)+"px",
                height:(chatBoxMaxHeight-70)+"px",
                padding:"5px 0 0 0 ",
                overflow:"auto"
            });
            $("#divChatBox").html(divFriendList.wrap("<div>").parent().html());
            createFriendList(msg,"FirstRun");
            
            setTimeout(function(){
                /*
                 * Adding the Search Box
                 */
                var divSearchFriend=$("<div></div>");
                divSearchFriend.attr("id","divSearchFriend");
                var lblSearchFriend=$("<label></label>");
                lblSearchFriend.attr("for","txtSearchFriend");
                lblSearchFriend.html("Search");
                var txtSearchFriend=$("<input />");
                txtSearchFriend.attr("id","txtSearchFriend");
                txtSearchFriend.attr("type","text");
                txtSearchFriend.attr("value","");
                divSearchFriend.append(lblSearchFriend.wrap("<div>").parent().html());
                divSearchFriend.append(txtSearchFriend.wrap("<div>").parent().html());
                $("#divChatBox").append(divSearchFriend.wrap("<div>").parent().html());
                $("#txtSearchFriend").bind('keyup',SearchFriend);
            },150);
            /**
             *  Start listening to the messages
             */
            ListenMessage();
        }
    });
    
    /**
     *  On Clicking a friend in friendlist a new window should be opened!
     *  or if there is an existing window then it should be focused
     */
    $("li.friend").live('click',chatFriend);
}


/**
 *  This function is called when finally the loading of chat box is complete
 */
function ListenMessage(timestamp){
    if(!timestamp){
        timestamp=0;
    }
    var userId=0;
    myUrl="ReceiveMessage.php?userId="+userId+"&timestamp="+timestamp;
    $.ajax({
        type:"GET",
        url:myUrl,
        cache:false,
        success:function(msg){
        		//alert("Got The Reply");
        	var maxTime=0;
            $.each(msg,function(key,value){
            	if(value.messageTo==userId){
                    alert("To User");
                }else if(value.messageFrom==userId){
                    var friendId=value.messageTo;
                    var chatBoxId="divChatBox_"+userId+"_"+friendId;
                    if($("#"+chatBoxId).length){
                    }else{
                        $("li#lblFriendId_"+friendId).trigger('click');
                    }
                    alert(value.created);
                    maxTime=value.created;
                }
            });
            //ListenMessage(maxTime);
        }
    });
}

/*
 * Function to search for friends in the Chat List
 */
function SearchFriend(e){
    var Friends=$.evalJSON($("#hidFriendList").val());
    var SearchedFriends=new Array();
    $.each(Friends,function(key,value){
        //alert($("#txtSearchFriend").val());
        var tempFriendName=value.name;
        tempFriendName=tempFriendName.toLowerCase();
        toSearchName=$("#txtSearchFriend").val().toLowerCase();
        if(tempFriendName.indexOf(toSearchName)!=-1){
            SearchedFriends.push(value);
        }
    });
    var div=createFriendList(SearchedFriends);
    var divFriendList=$("#divFriendList");
    divFriendList.html(div.html());
}


/**
 * Function that return the div list with object notations and hence provide div object as return
 * @param msg type:array 
 * @param type type:String
 * @return type div-object
 */

function createFriendList(msg,type){
    //  Chat Box Width
    var chatBoxWidth=250;
    //  Chat Box Maximum Height
    var chatBoxMaxHeight=400;
    //  Chat Box Minimum Height
    var div=$("<div></div>");
    var ul=$("<ul></ul>");
    $.each(msg,function(key,value){
        /**
         *  Deciding source for the image of the person
         */
        var src="";
        value.src==null?src="css/images/avatar.png":src=value.src;

        /*
         *  Creating image Object to append to the list item
         */
        var img=$("<img/>");
        img.attr("src",src);
        img.attr("alt","");
        /*
         *  Creating span Object to append to the list item
         */
        var span=$("<span></span>");
        span.html(value.name);

        var li=$("<li></li>");
        li.attr("id","lblFriendId_"+value.id);
        li.attr("class","friend");
        li.append(img.wrap("<div>").parent().html());
        li.append(span.wrap("<div>").parent().html());
        ul.append(li);
    });
    div.append(ul);
    

    setTimeout(function(){
        /**
         * Adding the Friendlist scroll
         */
        var divFriendList=$("#divFriendList");
        divFriendList.html(div.html());
        
        /**
         * For the Scrolling Effect.. Variable Width of the li for perfection
         */
        var ScrollDifference=($("#divFriendList")[0].scrollHeight-divFriendList.height());
        //alert(ScrollDifference);
        if(ScrollDifference>=27){
            $("#divChatBox ul>li.friend").css({
                minWidth:(chatBoxWidth-20)+"px",
                width:(chatBoxWidth-20)+"px",
                maxWidth:(chatBoxWidth-20)+"px"
            });
        }else{
            //alert("Changing Style");
            $("#divChatBox ul>li.friend").css({
                minWidth:(chatBoxWidth-3)+"px",
                width:(chatBoxWidth-3)+"px",
                maxWidth:(chatBoxWidth-3)+"px"
            });
        }
    }, 1);
}

/**
 * This Function is called when a friend in the list is clicked for chatting
 * @return type div-object
 */

function chatFriend(FriendId){
    if(typeof(FriendId)=="object"){
        FriendId=$(this).attr("id");
    }
    /*
     *  Extracting Friend ID and Name From List Item
     */
    var FriendName=$(this).find("span");
    FriendName=FriendName.text();
    FriendId=FriendId.substr(FriendId.indexOf("_")+1);
    
    /*
     *  Setting The User ID
     */
    var UserId=0;
    var ChatBoxId="divChatBox_"+ UserId +"_" + FriendId;
    var ChatBoxTitle=FriendName;
    if($("#"+ChatBoxId).length){
        $("#"+ChatBoxId).dialog({position:"center"});
        $("#"+ChatBoxId).dialog("moveToTop");
        /*
         *  Open the box if its in closed position
         */
        if($("div[aria-labelledby=ui-dialog-title-"+ChatBoxId+"]").height()<=30){
            $("#"+ChatBoxId).dialog("close");
        }
        
        return false;
    }
    
    /*
     *  Creating the area where the chat would be displayed
     */
    var divChatHistory=$("<div></div>");
    divChatHistory.attr("id","divChatHistory");
    /*
     *  Creating the div area the user would enter data for chatting
     */
    var divTextareaChatBox=$("<div></div>");
    divTextareaChatBox.attr("id","divTextareaChatBox");
    /*
     *  Creating the textarea the user would enter data for chatting
     */
    var textareaChatBox=$("<textarea></textarea>");
    textareaChatBox.attr({
        id:"textareaChatBox",
        rows:4,
        cols:10
    });
    textareaChatBox.css({
        minHeight:"20px"
    });
    textareaChatBox.bind('keypress',MonitorSentMessage);
    /**
     *  adding textarea to the div content
     */
    
    divTextareaChatBox.append(textareaChatBox);
    
    /**
     *  Creating area under which all this stuff would lie
     */
    var divInnerChatBox=$("<div></div>");
    divInnerChatBox.attr("id","divInnerChatBox");
    divInnerChatBox.append(divChatHistory);
    divInnerChatBox.append(textareaChatBox);
    var divChatBox=$("<div></div>");
    divChatBox.attr("id",ChatBoxId);
    divChatBox.attr("title",ChatBoxTitle);
    $(divChatBox).dialog({
        /**
         *  Setting Height width parameteres for the Chat Box
         */
        width:300,
        height:300,
        resizable:false,
        /**
         * dis-allowing closing of chatbbox
         */
        open:function(event,ui){
            /**
             *  Replacing Close buttom with the minimize-maximize toggle button
             */
            $(".ui-dialog-titlebar-close").html($("<span></span>").addClass("ui-icon ui-icon-triangle-2-n-s"));
        },
        beforeclose:function(event,ui){
            if(event.which==27){
                $(this).remove();
            }
            /**
             *  Minimizing and Maximizing the Chat Box according to the situation(toggle)
             */
            var chatBox=$("div[aria-labelledby=ui-dialog-title-"+divChatBox.attr("id")+"]");
            if(chatBox.height()<=51){
                chatBox.animate({
                    minHeight:300,
                    height:300
                });
            }else{
                chatBox.animate({
                    minHeight:30+"px",
                    height:30+"px"
                });
            }
            return false;
        }
    });
    divChatBox.append(divInnerChatBox);
    return true;
}

/*
*	This function is called when the friend list is loaded and hence then it starts monitoring
*	if any body pings or not!
*/
function MonitorSentMessage(event){
    if(event.which==13 && !event.shiftKey){
        var userId=0;
        var friendId=$(this).parent().parent().parent().find("div[id ^=divChatBox ]").attr("id").split("_")[2];
        var message=$(this).val();
        if(SendMessage(userId,friendId,message)){
            $(this).val(null);
            event.preventDefault();
        }
    }
}

/*
*	This Function is Used to send message to a particular friend by a user!
*/
function SendMessage(userId,friendId,message){
    if(userId==null || friendId==null || message==null){
        return false;
    }
    var data={userId:userId,friendId:friendId,message:message};
    $.ajax({
        cache:false,
        url:"SendMessage.php",
        data:data,
        type:"POST",
        success:function(msg){
            //alert(msg);
        }
    });
    return true;
}