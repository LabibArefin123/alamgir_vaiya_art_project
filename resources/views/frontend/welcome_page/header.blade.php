<header class="main-header">

    <nav class="main-navbar">

        <div class="header-container">

            <!-- Logo -->
            <div class="nav-left">

                <a href="{{ route('welcome') }}" class="brand-logo">

                    <div class="brand-text">

                        <h2>Alamgir Hai</h2>

                        <span>
                            Artist & Creative Visionary
                        </span>

                    </div>

                </a>

            </div>

            <!-- Desktop Menu -->
            <div class="nav-right" id="desktopMenu">

                <a href="{{ route('welcome') }}">
                    Home
                </a>

                <a href="#about">
                    About
                </a>

                <a href="#journey">
                    Journey
                </a>

                <a href="#artworks">
                    Artworks
                </a>

                <a href="{{ route('gallery') }}">
                    Gallery
                </a>

                <a href="#contact">
                    Contact
                </a>

            </div>

            <!-- Mobile Toggle -->
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

    </nav>

</header>
