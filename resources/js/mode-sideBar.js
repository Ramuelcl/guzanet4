// resources/js/mode-sideBar.js

// Icons
const dotsHorizontalIcon = document.querySelector(".dots-horizontal");
const dotsVerticalIcon = document.querySelector(".dots-vertical");

// Sidebar vars
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");
const switchSideBarIcon = document.querySelector(".switchSideBar");

// Sidebar state functions
const saveSidebarState = () => {
    const isSidebarHidden = sidebar.classList.contains("hidden");
    localStorage.setItem("sidebarHidden", isSidebarHidden);
};

// toggleSidebar
const toggleSidebar = () => {
    sidebar.classList.toggle("hidden");
    mainContent.classList.toggle("w-full");
    mainContent.classList.toggle("ml-0");

    if (sidebar.classList.contains("hidden")) {
        showHorizontalIcon();
    } else {
        showVerticalIcon();
    }

    saveSidebarState();
};

const showHorizontalIcon = () => {
    dotsHorizontalIcon.classList.remove("hidden");
    dotsVerticalIcon.classList.add("hidden");
};

const showVerticalIcon = () => {
    dotsHorizontalIcon.classList.add("hidden");
    dotsVerticalIcon.classList.remove("hidden");
};

switchSideBarIcon.addEventListener("click", () => {
    console.log("Toggle Sidebar clicked");
    toggleSidebar();
});

// Restore sidebar state on page load
const storedSidebarHidden = localStorage.getItem("sidebarHidden");
if (storedSidebarHidden === "true") {
    sidebar.classList.add("hidden");
    mainContent.classList.add("w-full", "ml-0");
    showHorizontalIcon();
} else {
    showVerticalIcon();
}
