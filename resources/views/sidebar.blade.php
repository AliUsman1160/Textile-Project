<style>
    /*===== GOOGLE FONTS =====*/
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

    /*===== VARIABLES CSS =====*/
    :root {
        --header-height: 3rem;
        --nav-width: 68px;

        /*===== Colors =====*/
        --first-color: #0a043c;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;

        /*===== Font and typography =====*/
        --body-font: 'Nunito', sans-serif;
        --normal-font-size: 1rem;

        /*===== z index =====*/
        --z-fixed: 100;
    }

    /*===== BASE =====*/
    *,
    ::before,
    ::after {
        box-sizing: border-box;
    }

    body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 1rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: .5s;
    }

    a {
        text-decoration: none;
    }

    .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: var(--white-color);
        z-index: var(--z-fixed);
        transition: .5s;
    }

    .header__toggle {
        color: var(--first-color);
        font-size: 1.5rem;
        cursor: pointer;
    }

    .header__img {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden;
    }

    .header__img img {
        width: 40px;
    }

    .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background: var(--first-color);
        padding: 0.5rem 1rem 0 0;
        transition: 0.5s;
        z-index: var(--z-fixed);
        overflow-y: auto;
        /* Change to 'auto' */
        max-height: 100vh;
        /* Set a maximum height to prevent the sidebar from becoming too long */
    }

    .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }

    .nav__logo,
    .nav__link {
        display: grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding-left: 1.5rem;
        /* padding:.5rem 0 .5rem 1.5rem; */
    }

    .nav__logo {
        margin-bottom: 1rem;
    }

    .nav__logo-icon {
        font-size: 1.25rem;
        color: var(--white-color);
    }

    .nav__logo-name {
        font-weight: 700;
        color: var(--white-color);
    }

    .nav__link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: 0.5rem;
        transition: .3s;
    }

    .nav__link:hover {
        color: var(--white-color);
    }

    .nav__icon {
        font-size: 1.25rem;
    }

    .show {
        left: 0;
    }

    .body-pd {
        padding-left: calc(var(--nav-width) + 1rem);
    }

    .active {
        color: var(--white-color);
    }

    .active::before {
        content: '';
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--white-color);
    }

    h1 {
        padding: 2rem 0 0;
    }

    p {
        color: #333;
        line-height: 1.6;
    }

    @media screen and (min-width:768px) {
        body {
            margin: calc(var(--header-height) + 1rem) 0 0 0;
            padding-left: calc(var(--nav-width) + 2rem);
        }

        .header {
            height: calc(var(--header-height) + 1rem);
            padding: 0 1rem 0 calc(var(--nav-width) + 1rem);
        }

        .header__img {
            width: 40px;
            height: 40px;
        }

        .header__img img {
            width: 45px;
        }

        .l-navbar {
            left: 0;
            padding: 1rem 1rem 0 0;
        }

        .show {
            width: calc(var(--nav-width) + 156px);
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 188px);
        }

        .submenu ul {
            display: none;
        }

        .nav__logo,
        .nav__link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            /* padding-left: 1.5rem; */
            padding: .5rem 0 .5rem 1.5rem;
        }
    }

    .submenu ul.show-submenu {
        display: block;
    }



    .sub-menu-li {
        padding-left: 20px;
        color: var(--first-color-light);
    }

    .sub-menu-li:hover {
        color: white;
    }

    .submenu1 ul {
        display: none;
    }

    .submenu1 ul.show-submenu1 {
        display: block;
    }

    .submenu2 ul {
        display: none;
    }

    .submenu2 ul.show-submenu2 {
        display: block;
    }

    .submenu3 ul {
        display: none;
    }

    .submenu3 ul.show-submenu3 {
        display: block;
    }

    .submenu4 ul {
        display: none;
    }

    .submenu4 ul.show-submenu4 {
        display: block;
    }

    .submenu5 ul {
        display: none;
    }

    .submenu5 ul.show-submenu5 {
        display: block;
    }


    ul {
        list-style-type: none;
    }


    .page-indicate {
        color: blue;
        padding-top: 2px;
    }


    .main-color {
        background-color: var(--first-color);
        color: white;
    }

    .main-color:hover {
        background-color: var(--first-color);
        color: lightgray;
    }
</style>

<header class="header" id="header">
    <div class="header__toggle">
        <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <div class="d-flex">
        <p class="mx-3 my-2" style="font-size: 18px">Hi, {{ auth()->user()->name() }}</p>
        <div class="header__img">
            <img decoding="async" src="{{ asset('img/a-1.png') }}" alt="Image">
        </div>
    </div>
</header>

<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav__logo">
                <i class='bx bx-layer nav__logo-icon'></i>
                <span class="nav__logo-name">Textile</span>
            </a>
            <div class="nav__list">
                <a href="/dashboard" class="nav__link">
                    <i class='bx bx-grid-alt nav__icon'></i>
                    <span class="nav__name">Dashboard</span>
                </a>
                <div class="submenu1">
                    <a href="#" class="nav__link" data-submenu-class="submenu1" style="padding-bottom: 3px">
                        <img decoding="async" style="width: 20px" src="{{ asset('icon/yarn.png') }}" alt="Image">

                        <span class="nav__name">Yarn
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li class="py-1"><a href="/slae_yarn" class="sub-menu-li">Sale Yarn</a></li>
                        <li><a href="/purchace_yarn" class="sub-menu-li">Purchase Yarn</a></li>
                        <li><a href="/yarn_invontry" class="sub-menu-li">Yarn Invontry</a></li>

                        
                    </ul>
                </div>
                <div class="submenu2">
                    <a href="#" class="nav__link" data-submenu-class="submenu2" style="padding-bottom: 3px">
                        <img decoding="async" style="width: 20px" src="{{ asset('icon/fabric.png') }}" alt="Image">


                        <span class="nav__name">Fabric
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li class="py-1"><a href="/slae_fabric" class="sub-menu-li">Sale Fabric</a></li>
                        <li><a href="/purchase_fabric" class="sub-menu-li">Purchase Fabric</a></li>
                        <li><a href="/fabric_invontry" class="sub-menu-li">Fabric Invontry</a></li>
                        
                    </ul>
                </div>
                <div class="submenu3">
                    <a href="#" class="nav__link" data-submenu-class="submenu3" style="padding-bottom: 3px">
                        <img decoding="async" style="width: 20px" src="{{ asset('icon/suit.png') }}" alt="Image">

                        <span class="nav__name">Suit
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li class="py-1"><a href="/slae_suit" class="sub-menu-li">Sale Suit</a></li>
                        <li><a href="/purchase_suit" class="sub-menu-li">Purchase Suit</a></li>
                        <li><a href="/suitinvontry" class="sub-menu-li">Suit Invontry</a></li>
                    </ul>
                </div>

                <div class="submenu4">
                    <a href="#" class="nav__link" data-submenu-class="submenu4" style="padding-bottom: 3px">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <span class="nav__name">Convertion
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </a>
                    <ul>
                        <li class="py-1"><a href="/yarntofabric" class="sub-menu-li">Yarn to Fabric</a></li>
                        <li><a href="/fabrictosuit" class="sub-menu-li">Fabric to Suit</a></li>
                    </ul>
                </div>

                <a href="/addstakeholders" class="nav__link">
                    <i class="fa-regular fa-plus nav__icon"></i>
                    <span class="nav__name">Stakeholder</span>
                </a>
                @if (auth()->check() && auth()->user()->isSuperuser())
                    <div class="submenu5">
                        <a href="#" data-submenu-class="submenu5" class="nav__link" style="padding-bottom: 3px">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <span class="nav__name">Account
                                <i class="fa-solid fa-angle-down"></i>
                            </span>
                        </a>
                        <ul>
                            <li class="py-1"><a href="/supplieraccounts" class="sub-menu-li">Suppliers</a></li>
                            <li><a href="/purchaseraccounts" class="sub-menu-li">Purchasers</a></li>
                        </ul>
                    </div>
                    <a href="/user" class="nav__link">
                        <i style="font-size: 18px;" class="fa-regular fa-user nav__icon"></i>
                        <span class="nav__name">User</span>
                    </a>
                @endif


            </div>
        </div>
        <a href="/logout" class="nav__link">
            <i class='bx bx-log-out nav__icon'></i>
            <span class="nav__name">Log Out</span>
        </a>
    </nav>
</div>


<!--===== MAIN JS =====-->
<script>
    const toggleSubmenu = (link, submenu, submenuClass) => {
        link.addEventListener('click', () => {
            // Hide all other submenus
            document.querySelectorAll('.nav__link').forEach(otherLink => {
                if (otherLink !== link) {
                    const otherSubmenu = otherLink.nextElementSibling;
                    if (otherSubmenu) {
                        otherSubmenu.classList.remove(`show-${otherLink.dataset.submenuClass}`);
                    }
                }
            });

            // Toggle the clicked submenu
            submenu.classList.toggle(`show-${submenuClass}`);
        });
    };

    const showNavbar = (toggleId, navId, bodyId, headerId, submenus) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);

        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                nav.classList.toggle('show');
                toggle.classList.toggle('bx-x');
                bodypd.classList.toggle('body-pd');
                headerpd.classList.toggle('body-pd');

                // Hide all submenus
                submenus.forEach(submenuClass => {
                    document.querySelectorAll(`.${submenuClass}`).forEach(submenu => {
                        submenu.classList.remove(`show-${submenuClass}`);
                    });
                });
            });
        }
    };

    const submenuLinks = document.querySelectorAll('.nav__link');
    submenuLinks.forEach(link => {
        const submenu = link.nextElementSibling;
        if (submenu) {
            toggleSubmenu(link, submenu, link.dataset.submenuClass);
        }
    });

    const submenuClasses = [
        'submenu1',
        'submenu2',
        'submenu3',
        'submenu4',
        'submenu5'
    ];

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header', submenuClasses);
</script>


