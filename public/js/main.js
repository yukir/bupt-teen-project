$(function(){
    $(".button-collapse").sideNav();
    $('.modal').modal();
    
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function Request(strName) {
        var strHref = window.document.location.href;
        var intPos = strHref.indexOf("?");
        var strRight = strHref.substr(intPos + 1);

        var arrTmp = strRight.split("&");
        for(var i = 0; i < arrTmp.length; i++)
        {
            var arrTemp = arrTmp[i].split("=");

            if(arrTemp[0].toUpperCase() == strName.toUpperCase()) return arrTemp[1];
        }
        return "";
    }

    if (Request("type")!="" && $(".active_check").length>0) {
        var $type = Request("type");
        $(".active_check").each(function(){
            //console.log($type);
            if($.inArray($type, ["sxyl","yxtx","mzy"])>=0) $(this).children(".sxyl_li").addClass("active");
            else if($.inArray($type, ["zttr","tgpx"])>=0) $(this).children(".jctj_li").addClass("active");
            else if($type == "xywh") $(this).children(".xywh_li").addClass("active");
        });
    }
    
});