<template>
    <div class="page-wrapper">
        <nav class="navbar">
            <div class="logo-section">
                <img class="avdk-icon" src="https://www.avkempen.be/assets/images/logo.png" />
                <h2 class="logo-text">A.V. de Kempen</h2>
            </div>
            <div class="nav-links">
                <a href="#" class="nav-link">Nieuws</a>
                <a href="#" class="nav-link">Documenten</a>
                <div class="devider"></div>
                <a href="#" class="icon-link">
                    <img src="https://www.avkempen.be/assets/images/playstore.webp" alt="Google Play"
                        class="store-icon" />
                </a>
                <a href="#" class="icon-link">
                    <img src="https://www.avkempen.be/assets/images/apple.png" alt="App Store" class="store-icon" />
                </a>
            </div>
        </nav>

        <main class="main-content">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <img class="footer-logo" src="https://www.avkempen.be/assets/images/logo.png"
                        alt="A.V. de Kempen logo" />
                    <div>
                        <p class="footer-title">Officiële website</p>
                    </div>
                </div>
                <div class="footer-middle">
                    <a href="#" class="footer-link">Wedstrijden</a>
                    <a href="#" class="footer-link">Nieuws</a>
                    <a href="#" class="footer-link">Documenten</a>
                </div>
                <div class="footer-right">
                    <p class="footer-download-text">Download de app</p>
                    <div class="store-icons">
                        <a href="#"><img src="https://www.avkempen.be/assets/images/playstore.webp" alt="Google Play"
                                class="store-icon-footer" /></a>
                        <a href="#"><img src="https://www.avkempen.be/assets/images/apple.png" alt="App Store"
                                class="store-icon-footer" /></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">Ontwikkeld door W.H.</div>
        </footer>
    </div>
</template>

<style>
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f8f8f8;
}

.page-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.main-content {
    flex: 1;
}

/* NAVBAR STYLES */
.navbar {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 10px 20px;
    background-color: #fff;
    border-bottom: 1px solid #f0f0f0;
}

.logo-section {
    display: flex;
    align-items: center;
}

.avdk-icon {
    height: 50px;
    filter: brightness(0);
}

.logo-text {
    font-size: 18px;
    font-weight: bold;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 20px;
}

.devider {
    width: 1px;
    height: 30px;
    background-color: #e6e6e6;
}

.nav-link {
    color: #13151b;
    font-size: 1.15rem;
    font-weight: 600;
    text-decoration: none !important;
}

.nav-link:hover {
    text-decoration: underline;
}

.icon-link {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background-color: #e6e6e6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.store-icon {
    max-height: 1rem;
    max-width: 1rem;
}

/* FOOTER STYLES */
.footer {
    background-color: #eaeaea;
    font-family: 'Montserrat', sans-serif;
    text-align: center;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 4rem 2rem;
}

.footer-left,
.footer-middle,
.footer-right {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer-logo {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: #ff1744;
    margin-bottom: 2rem;
}

.footer-title {
    font-weight: 600;
    margin: 0;
}

.footer-subtitle {
    font-size: 0.95rem;
    margin: 0;
    color: #333;
}

.footer-link {
    margin: 0.25rem 0;
    color: #13151b;
    font-weight: 600;
    text-decoration: none;
}

.footer-link:hover {
    text-decoration: underline;
}

.footer-download-text {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.store-icons {
    display: flex;
    gap: 0.5rem;
}

.footer-right .store-icon-footer {
    object-fit: contain;
    width: 50px;
    height: 50px;
    background-color: #dedede;
    border-radius: 50%;
    padding: 0.7rem;
}

.footer-bottom {
    padding: 1.5rem;
    margin-top: 1rem;
    font-size: 0.8rem;
    color: #666;
    background-color: #dedede;
}

/* RESPONSIVE */
@media (min-width: 768px) {
    .footer-content {
        flex-direction: row;
        justify-content: space-evenly;
        align-items: flex-start;
        text-align: left;
    }

    .footer-left,
    .footer-middle,
    .footer-right {
        align-items: flex-start;
    }

    .footer-bottom {
        text-align: center;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        gap: 10px;
    }

    .nav-links {
        gap: 10px;
    }
}
</style>
