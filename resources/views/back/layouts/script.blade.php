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
    document.addEventListener("DOMContentLoaded", function () {

        document.addEventListener(
            "DOMContentLoaded",
            function () {

                const toggle =
                    document.getElementById(
                        "userDropdownToggle"
                    );

                const menu =
                    document.getElementById(
                        "userDropdownMenu"
                    );


                if (!toggle || !menu) {
                    return;
                }


                toggle.addEventListener(
                    "click",
                    function (event) {

                        event.stopPropagation();

                        menu.classList.toggle("show");

                    }
                );


                document.addEventListener(
                    "click",
                    function (event) {

                        if (
                            !toggle.contains(event.target) &&
                            !menu.contains(event.target)
                        ) {
                            menu.classList.remove("show");
                        }

                    }
                );

            }
        );

        document.addEventListener("click", function (e) {

            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove("show");
            }

        });

    });
    /* ============================================
       SIDEBAR RÉDUITE / OUVERTE SUR DESKTOP
    ============================================ */

    document.addEventListener('DOMContentLoaded', function () {

        const collapseButton =
            document.getElementById('collapseSidebar');

        const sidebar =
            document.getElementById('sidebar');

        if (!collapseButton || !sidebar) {
            return;
        }


        /* Restaurer le dernier état */

        const savedState =
            localStorage.getItem('youlida-sidebar-collapsed');


        if (
            savedState === 'true' &&
            window.innerWidth > 991
        ) {
            document.body.classList.add(
                'sidebar-collapsed'
            );
        }


        function updateCollapseButton() {

            const collapsed =
                document.body.classList.contains(
                    'sidebar-collapsed'
                );

            collapseButton.title =
                collapsed
                    ? 'Agrandir le menu'
                    : 'Réduire le menu';

            collapseButton.setAttribute(
                'aria-label',
                collapsed
                    ? 'Agrandir le menu'
                    : 'Réduire le menu'
            );
        }


        updateCollapseButton();


        collapseButton.addEventListener(
            'click',
            function () {

                /* Le mode réduit concerne le PC */

                if (window.innerWidth <= 991) {
                    return;
                }


                document.body.classList.toggle(
                    'sidebar-collapsed'
                );


                const collapsed =
                    document.body.classList.contains(
                        'sidebar-collapsed'
                    );


                localStorage.setItem(
                    'youlida-sidebar-collapsed',
                    collapsed ? 'true' : 'false'
                );


                /* Fermer les sous-menus */

                if (collapsed) {

                    document
                        .querySelectorAll(
                            '.has-submenu.open'
                        )
                        .forEach(function (item) {

                            item.classList.remove('open');

                        });
                }


                updateCollapseButton();
            }
        );


        /* Si on passe PC -> mobile */

        window.addEventListener(
            'resize',
            function () {

                if (window.innerWidth <= 991) {

                    document.body.classList.remove(
                        'sidebar-collapsed'
                    );

                } else {

                    const state =
                        localStorage.getItem(
                            'youlida-sidebar-collapsed'
                        );

                    if (state === 'true') {

                        document.body.classList.add(
                            'sidebar-collapsed'
                        );

                    }

                }

                updateCollapseButton();
            }
        );

    });

    // ======================================================
    // MENU UTILISATEUR
    // ======================================================

    const userToggle = document.getElementById('userDropdownToggle');
    const userMenu = document.getElementById('userDropdownMenu');

    if (userToggle && userMenu) {

        userToggle.addEventListener('click', function (event) {

            event.stopPropagation();

            const isOpen = userMenu.classList.toggle('show');

            userToggle.setAttribute(
                'aria-expanded',
                String(isOpen)
            );

            // Fermer les notifications
            if (dropdown) {
                dropdown.classList.remove('show');
            }

            if (toggle) {
                toggle.setAttribute(
                    'aria-expanded',
                    'false'
                );
            }
        });


        userMenu.addEventListener('click', function (event) {
            event.stopPropagation();
        });


        document.addEventListener('click', function () {

            userMenu.classList.remove('show');

            userToggle.setAttribute(
                'aria-expanded',
                'false'
            );
        });

    }
</script>