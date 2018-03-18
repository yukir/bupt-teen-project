$(function(){
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
            //TODO
        });
    }
    
});