<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<style>
    :root {
    --sidebar-width: 260px;
    --sidebar-collapsed-width: 78px;
    --sidebar-bg: #0f172a;
        --sidebar-hover: #1e293b;
        --primary-color: #2563eb;
        --secondary-color: #64748b;
        --light-bg: #f8fafc;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-light: #94a3b8;
        --border-color: #e2e8f0;
        --success-color: #16a34a;
        --warning-color: #f59e0b;
        --danger-color: #dc2626;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: var(--light-bg);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
    }

    a {
        text-decoration: none;
    }

    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        overflow-y: auto;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .sidebar-brand {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .sidebar-brand h4 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
        color: #fff;
    }

    .sidebar-brand small {
        color: var(--text-light);
    }

    .sidebar-menu {
        padding: 18px 0;
    }

    .sidebar-menu .menu-title {
        padding: 12px 20px 8px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
    }

    .sidebar-menu ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .sidebar-menu ul li {
        margin: 4px 0;
    }

    .sidebar-menu ul li a {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #e2e8f0;
        padding: 12px 20px;
        transition: 0.3s ease;
        font-size: 15px;
        font-weight: 500;
        border-left: 3px solid transparent;
    }

    .sidebar-menu ul li a:hover,
    .sidebar-menu ul li a.active {
        background: var(--sidebar-hover);
        color: #fff;
        border-left: 3px solid var(--primary-color);
    }

    .sidebar-menu ul li a i {
        width: 20px;
        text-align: center;
    }

    /* MAIN */
    .main-content {
    margin-left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    min-height: 100vh;
    display: flex;
    flex-direction: column;

    transition:
        margin-left 0.3s ease,
        width 0.3s ease;
}

    /* HEADER */
    .admin-header {
        background: #fff;
        border-bottom: 1px solid var(--border-color);
        padding: 18px 25px;
    }

    .admin-header .page-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .admin-header .page-subtitle {
        color: var(--secondary-color);
        font-size: 14px;
        margin: 0;
    }

    /* TOPBAR */
    .topbar {
        background: #fff;
        border-bottom: 1px solid var(--border-color);
        padding: 14px 25px;
    }

    .topbar .user-box {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .topbar .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: var(--primary-color);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .topbar .user-name {
        font-weight: 600;
        margin-bottom: 0;
    }

    .topbar .user-role {
        font-size: 13px;
        color: var(--secondary-color);
        margin-bottom: 0;
    }

    /* CONTENT */
    .page-content {
        padding: 25px;
        flex: 1;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
        border: 1px solid var(--border-color);
        height: 100%;
    }

    .stat-card .icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        margin-bottom: 14px;
    }

    .bg-primary-soft { background: var(--primary-color); }
    .bg-success-soft { background: var(--success-color); }
    .bg-warning-soft { background: var(--warning-color); }
    .bg-danger-soft { background: var(--danger-color); }

    .stat-card h6 {
        color: var(--secondary-color);
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-card h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .custom-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .custom-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--border-color);
        padding: 18px 20px;
        font-weight: 700;
    }

    .custom-card .card-body {
        padding: 20px;
    }

    .table thead th {
        background: #f8fafc;
        color: var(--text-dark);
        font-size: 14px;
        border-bottom: 1px solid var(--border-color);
    }

    .badge-soft-success {
        background: rgba(22, 163, 74, 0.12);
        color: var(--success-color);
        padding: 8px 12px;
        border-radius: 50px;
        font-size: 12px;
    }

    .badge-soft-warning {
        background: rgba(245, 158, 11, 0.15);
        color: #b45309;
        padding: 8px 12px;
        border-radius: 50px;
        font-size: 12px;
    }

    .badge-soft-danger {
        background: rgba(220, 38, 38, 0.12);
        color: var(--danger-color);
        padding: 8px 12px;
        border-radius: 50px;
        font-size: 12px;
    }


    /* =========================================================
   SIDEBAR COLLAPSIBLE - DESKTOP
========================================================= */

.sidebar-brand {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.sidebar-brand-text {
    min-width: 0;
    transition: opacity 0.2s ease;
}

.sidebar-collapse-btn {
    width: 34px;
    height: 34px;
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 8px;

    background: rgba(255, 255, 255, 0.06);
    color: #cbd5e1;

    cursor: pointer;

    transition: all 0.25s ease;
}

.sidebar-collapse-btn:hover {
    background: rgba(255, 255, 255, 0.14);
    color: #fff;
}


/* Badge nouveaux messages */

.youth-message-badge {
    margin-left: auto;

    min-width: 22px;
    height: 22px;
    padding: 0 6px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: var(--danger-color);
    color: #fff;

    border-radius: 999px;

    font-size: 11px;
    font-weight: 700;
    line-height: 1;
}


/* ================================
   SIDEBAR RÉDUITE
================================ */

body.sidebar-collapsed .sidebar {
    width: var(--sidebar-collapsed-width);
}


body.sidebar-collapsed .main-content {
    margin-left: var(--sidebar-collapsed-width);

    width: calc(
        100% - var(--sidebar-collapsed-width)
    );
}


/* Marque */

body.sidebar-collapsed .sidebar-brand {
    padding-left: 12px;
    padding-right: 12px;

    justify-content: center;
}

body.sidebar-collapsed .sidebar-brand-text {
    display: none;
}


/* Bouton */

body.sidebar-collapsed .sidebar-collapse-btn i {
    transform: rotate(180deg);
}


/* Titres Navigation / Système */

body.sidebar-collapsed .sidebar-menu .menu-title {
    display: none;
}


/* Espacement général */

body.sidebar-collapsed .sidebar-menu {
    padding-top: 15px;
}


/* Liens */

body.sidebar-collapsed .sidebar-menu > ul > li > a {
    width: 52px;
    min-height: 46px;

    margin-left: auto;
    margin-right: auto;

    padding: 12px;

    justify-content: center;

    position: relative;
}


/* Div interne des menus avec sous-menu */

body.sidebar-collapsed
.sidebar-menu > ul > li > a > div {
    justify-content: center;
}


/* Icônes */

body.sidebar-collapsed
.sidebar-menu > ul > li > a i {
    margin: 0;
    width: 20px;

    font-size: 17px;
}


/* Cache tous les textes */

body.sidebar-collapsed
.sidebar-menu > ul > li > a span:not(.youth-message-badge) {
    display: none;
}


/* Cache flèches des sous-menus */

body.sidebar-collapsed .submenu-arrow {
    display: none;
}


/* Ferme visuellement les sous-menus */

body.sidebar-collapsed .submenu {
    display: none !important;
}


/* Badge du message sur l'icône */

body.sidebar-collapsed .youth-message-badge {
    position: absolute;

    top: 3px;
    right: 2px;

    min-width: 18px;
    height: 18px;

    padding: 0 5px;

    font-size: 10px;

    border: 2px solid var(--sidebar-bg);
}
    @media (max-width: 991px) {
        .sidebar {
            left: -260px;
        }

        .sidebar.show {
            left: 0;
        }


        .main-content {
            margin-left: 0;
            width: 100%;
        }

        body.sidebar-collapsed .sidebar {
    width: var(--sidebar-width);
}

body.sidebar-collapsed .main-content {
    margin-left: 0;
    width: 100%;
}

.sidebar-collapse-btn {
    display: none;
}
    }
    .sidebar-menu ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .sidebar-menu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 18px;
        color: #cbd5e1;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 4px 10px;
        font-size: 14px;
    }

    .sidebar-menu ul li a div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-menu ul li a:hover,
    .sidebar-menu ul li a.active {
        background: rgba(255,255,255,0.08);
        color: #fff;
    }

    .has-submenu .submenu {
        display: none;
        padding-left: 12px;
        margin-top: 4px;
    }

    .has-submenu.open .submenu {
        display: block;
    }

    .submenu li a {
        font-size: 13px;
        padding: 10px 16px;
        color: #94a3b8;
    }

    .submenu li a.active,
    .submenu li a:hover {
        color: #fff;
        background: rgba(255,255,255,0.06);
    }

    .submenu-arrow {
        transition: transform 0.3s ease;
        font-size: 12px;
    }

    .has-submenu.open > a .submenu-arrow {
        transform: rotate(180deg);
    }
    .user-dropdown{
position:relative;
}

.user-box{
display:flex;
align-items:center;
gap:10px;
cursor:pointer;
}

.avatar{
width:40px;
height:40px;
border-radius:50%;
background:#4f46e5;
color:#fff;
display:flex;
align-items:center;
justify-content:center;
font-weight:bold;
}

.dropdown-menu-user{

position:absolute;
right:0;
top:55px;

background:white;
width:200px;

border-radius:8px;

box-shadow:0 8px 20px rgba(0,0,0,0.1);

display:none;

flex-direction:column;

padding:10px 0;

z-index:999;

}

.dropdown-menu-user a{

padding:10px 18px;

display:flex;

gap:10px;

align-items:center;

text-decoration:none;

color:#333;

font-size:14px;

}

.dropdown-menu-user a:hover{

background:#f3f4f6;

}

.dropdown-menu-user hr{
margin:8px 0;
}

.dropdown-menu-user.show{
display:flex;
}
/* =========================================
   NOTIFICATIONS ADMIN
========================================= */

.admin-notification-wrapper {
    position: relative;
}

.admin-notification-toggle {
    position: relative;
    width: 44px;
    height: 44px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #fff;
    color: #374151;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.admin-notification-toggle:hover {
    background: #f3f4f6;
    color: var(--primary-color);
}

.admin-notification-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    min-width: 19px;
    height: 19px;
    padding: 0 4px;
    border-radius: 20px;
    background: #dc2626;
    color: white;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
}

.admin-notification-dropdown {
    position: absolute;
    top: calc(100% + 12px);
    right: 0;
    width: 370px;
    max-width: calc(100vw - 24px);
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    z-index: 1100;
    display: none;
    overflow: hidden;
}

.admin-notification-dropdown.show {
    display: block;
}

.admin-notification-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 16px;
    border-bottom: 1px solid #f1f5f9;
}

.admin-notification-header strong {
    font-size: 15px;
    color: #111827;
}

.admin-notification-header p {
    font-size: 12px;
    color: #6b7280;
    margin: 3px 0 0;
}

.admin-notification-read-all {
    border: none;
    background: transparent;
    color: var(--primary-color);
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    text-align: right;
}

.admin-notification-list {
    max-height: 380px;
    overflow-y: auto;
}

.admin-notification-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 15px;
    color: inherit;
    text-decoration: none;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s ease;
}

.admin-notification-item:hover {
    background: #f9fafb;
}

.admin-notification-item.unread {
    background: #eff6ff;
}

.admin-notification-icon {
    width: 36px;
    height: 36px;
    flex-shrink: 0;
    border-radius: 10px;
    background: #dbeafe;
    color: #2563eb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.admin-notification-content {
    flex: 1;
    min-width: 0;
}

.admin-notification-content strong {
    display: block;
    font-size: 13px;
    color: #111827;
}

.admin-notification-content p {
    font-size: 12px;
    color: #6b7280;
    margin: 4px 0;
    line-height: 1.5;
}

.admin-notification-reference {
    display: block;
    font-size: 11px;
    color: #2563eb;
    overflow-wrap: anywhere;
}

.admin-notification-date {
    display: block;
    margin-top: 5px;
    font-size: 11px;
    color: #9ca3af;
}

.admin-notification-dot {
    width: 8px;
    height: 8px;
    flex-shrink: 0;
    border-radius: 50%;
    background: #2563eb;
    margin-top: 6px;
}

.admin-notification-empty {
    padding: 35px 20px;
    text-align: center;
    color: #9ca3af;
}

.admin-notification-empty i {
    font-size: 25px;
    margin-bottom: 10px;
}

.admin-notification-empty p {
    font-size: 13px;
    margin: 0;
}

@media (max-width: 576px) {
    .topbar {
        padding: 12px 15px;
    }

    .admin-notification-dropdown {
        position: fixed;
        top: 75px;
        right: 12px;
        left: 12px;
        width: auto;
    }
}

.dashboard-kpi-card {
    position: relative;
    cursor: pointer;
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease,
        border-color 0.2s ease;
}

.dashboard-kpi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.10);
}

.dashboard-kpi-card .kpi-arrow {
    color: #94a3b8;
    font-size: 0.8rem;
    transition:
        color 0.2s ease,
        transform 0.2s ease;
}

.dashboard-kpi-card:hover .kpi-arrow {
    color: #0d6efd;
    transform: translate(2px, -2px);
}

.dashboard-kpi-card .kpi-link-label {
    color: #94a3b8;
    font-weight: 600;
    transition: color 0.2s ease;
}

.dashboard-kpi-card:hover .kpi-link-label {
    color: #0d6efd;
}
</style>
