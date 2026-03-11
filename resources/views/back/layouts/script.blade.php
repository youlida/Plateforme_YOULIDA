<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        if (toggleSidebar && sidebar) {
            toggleSidebar.addEventListener('click', function () {
                sidebar.classList.toggle('show');
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.submenu-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const parent = this.closest('.has-submenu');
                parent.classList.toggle('open');
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function(){

let toggle = document.getElementById("userDropdownToggle");
let menu = document.getElementById("userDropdownMenu");

toggle.addEventListener("click", function(){
menu.classList.toggle("show");
});

document.addEventListener("click", function(e){

if(!toggle.contains(e.target) && !menu.contains(e.target)){
menu.classList.remove("show");
}

});

});
</script>