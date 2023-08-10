// resources/js/mode-dark.js

// Icons
const sunIcon = document.querySelector(".sun");
const moonIcon = document.querySelector(".moon");

// Theme vars
const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

// Función para ocultar el ícono de luna y mostrar el ícono de sol
const showSunIcon = () => {
    sunIcon.classList.remove("hidden");
    moonIcon.classList.add("hidden");
};

// Función para ocultar el ícono de sol y mostrar el ícono de luna
const showMoonIcon = () => {
    moonIcon.classList.remove("hidden");
    sunIcon.classList.add("hidden");
};

const themeCheck = () => {
    if (userTheme === "dark" || (!userTheme && systemTheme)) {
        document.documentElement.classList.add("dark");
        showSunIcon();
        console.log("Tema actual: Oscuro");
        return;
    }
    document.documentElement.classList.remove("dark");
    showMoonIcon();
    console.log("Tema actual: Claro");
};

const themeSwitch = () => {
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem('theme', 'light');
        showMoonIcon();
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem('theme', 'dark');
        showSunIcon();
    }
};

const switchDark = document.querySelector(".switchDark");
switchDark.addEventListener("click", () => {
    themeSwitch();
});

// invoke theme check on initial load
themeCheck();

