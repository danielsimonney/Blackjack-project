console.log('salut cest les JS')
var TheAlert=document.querySelector('#myalert')
console.log(TheAlert)
if(TheAlert!=null){
    var myalert=(TheAlert.value)
    var type=TheAlert.name
    var title=TheAlert.title
    swal(title,myalert,type);
}