<template>
    <div>
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
        <main>
            <slot />
        </main>
    </div>
</template>

<script setup>
// No script logic needed for a static nav bar
</script>

<style>
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f8f8f8;
}

.navbar {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 20px 20px;
    background-color: #fff;
    border-bottom: 1px solid #e6e6e6;
    font-family: Arial, sans-serif;
}

.logo-section {
    display: flex;
    align-items: center;
}

.icon {
    font-size: 24px;
    margin-right: 8px;
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
    position: relative;
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

.avdk-icon {
    height: 50px;
    filter: brightness(0);
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
