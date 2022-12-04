// JavaScript Document
// SCRIPT THAT HIDES TOOL TIP INFO ABOUT MEMBER ON MOUSE OVER
function hideMemberInfo(memberImg)
{
	$(memberImg).next('table').css('display','none');
}
//#####################################################################################################################################################################
//#####################################################################################################################################################################
// SCRIPT THAT DISPLAY TOOP TIP INFO ABOUT MEMBER ON MOUSE OVER
function showMemberInfo_2(memberImg)
{
	$(memberImg).next('table').css('top',30);
	$(memberImg).next('table').css('left',-120);
	$(memberImg).next('table').css('display','block');
}