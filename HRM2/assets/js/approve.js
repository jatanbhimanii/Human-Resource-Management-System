const approve = document.getElementById("approve");
const view = document.getElementById("view");
let currentActive = 0;
approve.addEventListener("click",()=> 
{
    currentActive = 1;
    update();
});
function update(){
    if (currentActive ===1){
        view.disabled = true;
    } else{
        view.disabled = false;
    }
}