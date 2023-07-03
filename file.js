
function validation(){
    var mob =document.getElementById("mob").value;
        if(mob.length >10 || mob.length <10){
        alert("Number should be 10 Digit");
        return false;
        }


}