<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>
        Material Dashboard 3 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

    <style>
        body.dark-mode,
        body.dark-mode * {
            color: #fff !important;
        }

        body.dark-mode {
            background-color: #121212 !important;
        }

        /* Navbar override */
        body.dark-mode .navbar,
        body.dark-mode .navbar .navbar-brand,
        body.dark-mode .navbar .nav-link,
        body.dark-mode .navbar .sidenav-toggler-line {
            background-color: #1f1f1f !important;
            color: #fff !important;
        }

        /* Cards override */
        body.dark-mode .card,
        body.dark-mode .card-header,
        body.dark-mode .card-body {
            background-color: #1e1e1e !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        /* Pre / response body */
        body.dark-mode pre,
        body.dark-mode textarea {
            background-color: #1c1c1c !important;
            border-color: #444 !important;
            color: #38ff74 !important;
        }

        /* Input, form, select */
        body.dark-mode input,
        body.dark-mode .form-control,
        body.dark-mode select,
        body.dark-mode .input-group-text {
            background-color: #2b2b2b !important;
            color: #fff !important;
            border-color: #555 !important;
        }

        /* Table dark */
        body.dark-mode table,
        body.dark-mode .table {
            background-color: #1e1e1e !important;
            color: #fff !important;
        }

        body.dark-mode table tbody tr {
            background-color: #222 !important;
        }

        /* Sidebar Material Dashboard */
        body.dark-mode .sidenav {
            background-color: #181818 !important;
        }

        body.dark-mode .sidenav .nav-link {
            color: #fff !important;
        }

        /* Icon */
        body.dark-mode .material-icons,
        body.dark-mode .material-symbols-rounded {
            color: #fff !important;
        }

        /* ==== FIX AGAR TEKS DI BG-LIGHT TIDAK JADI PUTIH ==== */
        body.dark-mode .bg-light,
        body.dark-mode .bg-light * {
            color: #000 !important;
            /* teks jadi hitam */
        }

        /* badge method tetap warna bootstrap */
        body.dark-mode .badge.bg-info,
        body.dark-mode .badge.bg-primary,
        body.dark-mode .badge.bg-warning,
        body.dark-mode .badge.bg-secondary,
        body.dark-mode .badge.bg-danger,
        body.dark-mode .badge.bg-dark {
            color: #fff !important;
            /* badge tetap putih */
        }

        /* tombol hapus di history tetap merah */
        body.dark-mode #historyList button.btn-outline-danger {
            color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .navbar .form-check-label {
            display: flex;
            align-items: center;
            gap: 4px;
            line-height: 1;
        }

        .navbar .material-symbols-rounded {
            font-size: 18px;
            line-height: 1;
            vertical-align: middle;
        }

        .navbar .form-check-input {
            margin-top: 0;
        }

        /* wrapper logo */
        .navbar-logo-wrapper {
            display: flex;
            align-items: center;
        }

        /* ukuran logo */
        .navbar-logo {
            height: 32px;
            width: auto;
            object-fit: contain;
        }

        /* default (light mode) */
        .logo-dark {
            display: none;
        }

        /* saat dark mode */
        body.dark-mode .logo-light {
            display: none;
        }

        body.dark-mode .logo-dark {
            display: block;
        }

        .navbar-logo {
            transition: opacity 0.2s ease;
        }

        .sidebar-logo img {
            height: 90px;
            width: auto;
            object-fit: contain;
        }

        .app-wrapper {
            display: flex;
            min-height: 100vh;
            padding-left: 100px;
            /* ruang untuk sidebar */
        }

        .sidenav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100px !important;
            min-width: 100px !important;
            max-width: 100px !important;
            height: 100vh;
            z-index: 1030;
        }

        .sidenav .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 8px;
        }

        .sidenav .nav-link-text {
            font-size: 11px;
            margin-top: 4px;
        }

        .history-panel {
            width: 0;
            flex-shrink: 0;
            overflow: hidden;
            background: #fff;
            border-right: 1px solid #ddd;
            transition: width .25s ease;
        }

        .history-panel.show {
            width: 360px;
        }

        body.dark-mode .history-panel {
            background: #1e1e1e;
            border-color: #333;
        }

        /* .history-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
        } */

        body.dark-mode .history-panel-header {
            border-color: #333;
        }

        .history-panel-body {
            flex: 1;
            overflow-y: auto;
        }

        .history-item {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .history-item:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        body.dark-mode .history-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* TEXT AREA */
        .history-text {
            flex: 1;
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .history-delete {
            display: none;
            flex-shrink: 0;
        }

        /* hover → tombol MASUK layout */
        .history-item:hover .history-delete {
            display: inline-flex;
        }

        .history-main {
            display: flex;
            align-items: center;
            gap: 4px;
            flex: 1;
            min-width: 0;
        }

        .history-main strong {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .history-url {
            line-height: 1.4;
            display: flex;
            align-items: center;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 24px;
        }

        /* ===== PROFILE TAB FIX (DARK MODE) ===== */
        body.dark-mode .nav-pills {
            background-color: #1e1e1e;
        }

        body.dark-mode .nav-pills .nav-link {
            color: #ccc !important;
        }

        body.dark-mode .nav-pills .nav-link.active {
            background-color: #1e1e1e !important;
            color: #fff !important;
            border-radius: 8px;
        }

        /* ===============================
   NAV UPDATE BUTTON FIX
================================ */
.nav-pills {
    background: transparent;
}

.nav-pills .nav-link {
    color: #555;
    background: transparent;
    border-radius: 10px;
    transition: all 0.2s ease;
}

/* ===============================
   MODAL DARK MODE FIX
================================ */
body.dark-mode .modal-content {
    background-color: #1e1e1e;
    color: #eaeaea;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,.08);
}

body.dark-mode .modal-header,
body.dark-mode .modal-footer {
    border-color: rgba(255,255,255,.1);
}

body.dark-mode .modal-title {
    color: #fff;
}

body.dark-mode .btn-close {
    filter: invert(1);
}

/* ===============================
   FORM INPUT DARK
================================ */
body.dark-mode .styled-input {
    background-color: #121212;
    color: #fff;
    border-color: rgba(255,255,255,.15);
}

body.dark-mode .styled-input::placeholder {
    color: #777;
}

body.dark-mode .styled-input:focus {
    border-color: #0d6efd;
    box-shadow: none;
}

/* ===============================
   PROFILE IMAGE BUTTON
================================ */
body.dark-mode .edit-btn {
    background-color: #0d6efd;
}

body.dark-mode .edit-btn:hover {
    background-color: #0b5ed7;
}

/* ===============================
   MODAL ANIMATION
================================ */
.modal.fade .modal-dialog {
    transform: scale(0.95);
    transition: transform .2s ease;
}

.modal.show .modal-dialog {
    transform: scale(1);
}

    </style>

</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- SIDEBAR -->
    <aside class="sidenav collapsed navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start bg-white my-2 ms-2"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand px-4 py-4 m-0 d-flex justify-content-center" href="{{ route('wokaapi') }}">
                <div class="sidebar-logo navbar-logo-wrapper">
                    <img src="{{ asset('storage/gambar/Tanpa_judul__Logo_-removebg-preview.png') }}" class="navbar-logo logo-light" alt="logo">
                    <img src="{{ asset('storage/gambar/Gemini_Generated_Image_wvgywswvgywswvgy-removebg-preview.png') }}" alt="Logo Dark" class="navbar-logo logo-dark">
                </div>
            </a>
        </div>
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- Dashboard Admin(only)-->
                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('wokaapi') ? 'active bg-gradient-dark text-white' : '' }}"
                        href="{{ route('wokaapi') }}">
                        <i class="material-symbols-rounded">dashboard</i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('profile.index') ? 'active bg-gradient-dark text-white' : '' }}"
                        href="{{ route('profile.index') }}">
                        <i class="material-symbols-rounded">account_circle</i>
                        <span class="nav-link-text">profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="historyToggle" class="nav-link text-dark" href="#">
                        <i class="material-symbols-rounded">history</i>
                        <span class="nav-link-text">History</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Logout -->
        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn bg-gradient-danger w-100 mt-4 text-white">
                        <i class="material-symbols-rounded">logout</i>
                        <span class="nav-link-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>
    <!-- END SIDEBAR -->

    <div class="app-wrapper">
        <!-- HISTORY PANEL -->
        <div id="historyPanel" class="history-panel border-radius-lg my-2 ms-2">
            <div class="history-panel-header d-flex justify-content-between px-3 mt-3 border-bottom">
                <h6 class="mb-0">History</h6>
                <button id="clearHistoryBtn" class="btn btn-sm btn-outline-danger">
                    Clear
                </button>
            </div>

            <div id="historyList" class="history-panel-body p-2">
                <p class="text-muted small text-center mt-3">
                    Belum ada history.
                </p>
            </div>
        </div>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <ul class="navbar-nav ms-md-auto pe-md-3 d-flex align-items-center gap-4 justify-content-end">
                            <li class="nav-item d-flex align-items-center">
                                <div class="form-check form-switch m-0 d-flex align-items-center gap-2">
                                    <input class="form-check-input m-0" type="checkbox" id="darkSwitch">
                                    <label class="form-check-label m-0" for="darkSwitch">
                                        <span class="material-symbols-rounded">light_mode</span>
                                        <span>/</span>
                                        <span class="material-symbols-rounded">dark_mode</span>
                                    </label>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="ms-3">
                        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                    </div>
                </div>

                @yield('content')


                <footer class="footer py-4">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class=" mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm">
                                    © <script>
                                        document.write(new Date().getFullYear())
                                    </script>,
                                    made by <span class="font-weight-bold">Woka Project Mandiri</span> Team
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
    </div>

    <!--   Core JS Files   -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const body = document.body;
            const switchBtn = document.getElementById("darkSwitch");

            // load state
            if (localStorage.getItem("darkMode") === "on") {
                body.classList.add("dark-mode");
                switchBtn.checked = true;
            }

            switchBtn.addEventListener("change", function() {
                if (switchBtn.checked) {
                    body.classList.add("dark-mode");
                    localStorage.setItem("darkMode", "on");
                } else {
                    body.classList.remove("dark-mode");
                    localStorage.setItem("darkMode", "off");
                }
            });
        });

        document.getElementById('historyToggle').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('historyPanel').classList.toggle('show');
        });

        document.getElementById('closeHistory').addEventListener('click', function() {
            document.getElementById('historyPanel').classList.remove('show');
        });
    </script>


    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Views",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#43A047",
                    data: [50, 45, 22, 28, 50, 60, 76],
                    barThickness: 'flex'
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                            color: "#737373"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
                datasets: [{
                    label: "Sales",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                return fullMonths[context[0].dataIndex];
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 12,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Tasks",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: "#43A047",
                    pointBorderColor: "transparent",
                    borderColor: "#43A047",
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#737373',
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>