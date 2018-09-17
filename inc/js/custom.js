// ONE-TIME NOTICE

$(function() {
    var shown= localStorage.getItem('isshow');

    if(shown !="t"){
        $('#home-notice').removeClass("hide");
    }

	localStorage.setItem('isshow', 't');

	var shownMemberBenefitsNotice= localStorage.getItem('isShownMemberBenefitsNotice');

    if(shownMemberBenefitsNotice !="t"){
        $('#member-benefits').removeClass("hide");
    }

    $("#member-benefits--close").click(function(){
        localStorage.setItem('isShownMemberBenefitsNotice', 't');
        $("#member-benefits").toggleClass("hide");
    });
});
