const printBtn = document.querySelector("#printBtn");
const sideNavBtn = document.querySelector("#sideNavBtn");
const mySidenav = document.querySelector("#mySidenav");
printBtn.addEventListener("click", () => {
    printBtn.disabled = true;
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    sideNavBtn.style.visibility = "hidden";
    printBtn.style.visibility = "hidden";
    window.print();
    setTimeout(() => {
        printBtn.disabled = false;
        sideNavBtn.style.visibility = "visible";
        printBtn.style.visibility = "visible";
        mySidenav.style.visibility = "visible";
    }, 1000);
})