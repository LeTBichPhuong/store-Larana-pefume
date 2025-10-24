<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thương hiệu-LARANA PERFUME</title>
    <link rel="website icon" href="{{ asset('img/Logo.png') }}">
    <link rel="stylesheet" href="{{ asset('Brand.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Header -->
        <header>
            <nav class="nav-menu">
                <ul class="menu">
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('brand') }}">Thương hiệu</a></li>
                    <li class="logo"><a href="{{ route('home') }}"><img src="{{ asset('img/Logo.png') }}" alt="Logo"></a></a></li>
                    <li class="nav-item">
                        <a href="{{ route('products.list') }}">Sản phẩm</a>
                        <ul class="submenu">
                            <li><a href="{{ route('products.gender', ['gender' => 'nam']) }}">Nước hoa nam</a></li>
                            <li><a href="{{ route('products.gender', ['gender' => 'khac']) }}">Nước hoa nữ</a></li>
                            <li><a href="{{ route('products.gender', ['gender' => 'unisex']) }}">Nước hoa unisex</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <!-- Thanh tìm kiếm ẩn -->
                    <li class="search-container" style="position:relative;">
                        <a href="#" id="searchIcon"><i class="fa fa-search"></i></a>
                        <form id="searchForm" class="search-form" action="#" method="get" onsubmit="return false;">
                            <div class="search-box">
                                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm hoặc thương hiệu..." autocomplete="off" />
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                        <div id="searchResults" class="search-results" aria-live="polite"></div>
                    </li>
                    <!-- Tài khoản -->
                    <li>
                        @if(auth()->check())
                            <a href="{{ route('account') }}"><i class="fa fa-user"></i></a>
                        @else
                            <a href="{{ route('login') }}"><i class="fa fa-user"></i></a>
                        @endif
                    </li>
                    <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </nav> 
        </header>
    <!-- End header -->

    <!-- Main -->
        <main class="brand-main">
            <div class="container">
                <h1 class="title">THƯƠNG HIỆU</h1>

                <!-- Bộ lọc chữ cái -->
                <ul id="brands-filter" class="letter-filter">
                <li><a data-letter="all" class="all active">ALL BRANDS</a></li>
                </ul>

                <!-- Danh sách thương hiệu -->
                <div id="brand-list" >
                <!-- JS render các nhóm A, B, C... vào đây -->
                </div>
                
                <!-- Sản phẩm thương hiệu -->
                @yield('brand-products')
            </div>
        </main>
    <!-- End Main -->

    <!-- Footer -->
        <footer>
            <div class="footer-top">
                <div class="title-sub">
                    <h2>Đăng ký thành viên để nhận khuyến mãi</h2>
                    <p>Theo dõi chúng tôi để nhận nhiều ưu đãi</p>
                </div>
                <div class="subscribe">
                    <input type="email" placeholder="Nhập email, SĐT của bạn">
                    <button class="btn-sub"><i class='bx bxs-navigation'></i></button>
                </div>
            </div>
            <hr class="section-divider">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Kết nối với Larana</h3>
                    <div class="social-icons">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-x-twitter"></i>
                        <i class="fab fa-pinterest"></i>
                        <i class="fab fa-instagram"></i>
                    </div>
                    <p>TỔNG ĐÀI TƯ VẤN MIỄN PHÍ</p>
                    <p>Chi nhánh HÀ NỘI<br>0386759355</p>

                </div>

                <div class="footer-section">
                    <h3>Chính sách bán hàng</h3>
                    <ul>
                        <li>Chính sách và quy định chung</li>
                        <li>Chính sách bảo mật</li>
                        <li>Vận chuyển và giao nhận</li>
                        <li>Mua hàng và thanh toán</li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3>Thông tin chung</h3>
                    <ul>
                        <li>Giới thiệu</li>
                        <li>Blog</li>
                        <li>Liên hệ</li>
                        <li>Sản phẩm</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© Larana 2025 | all rights reserved</p>
            </div>
        </footer>
    <!-- End footer -->

    <script src="{{ asset('JS/script.js') }}"></script>
    <script src="{{ asset('JS/Brand.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>