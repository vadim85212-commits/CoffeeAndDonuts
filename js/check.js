let check = false;
let checkbox = document.getElementById('checkbox');
let checkelem = document.getElementById('check');
function checkBox(){
    if(check == true){
        checkelem.style.background = "#d0d2d3";
        checkbox.style.marginLeft = '0px';
        check = false; 
    }
    else{
        checkelem.style.background = 'lightgreen';
        checkbox.style.marginLeft = '25px';
        check = true; 
    }

}