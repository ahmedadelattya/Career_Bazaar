function setTheme(theme) {
    document.documentElement.classList.toggle("dark", theme === "dark");
    localStorage.setItem("theme", theme);
    updateIcon(theme); // Call the function to update the icon
}

function toggleDarkMode() {
    const currentTheme =
        localStorage.getItem("theme") === "dark" ? "light" : "dark";
    setTheme(currentTheme);
}

function updateIcon(theme) {
    const iconBtn = document.getElementById("theme-icon-button");

    // Sun and moon icon as SVG strings
    const sunIcon = `
  <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
  </svg>`;

    const moonIcon = `
  <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z"/>
  </svg>`;

    // Inject the appropriate icon based on the theme
    if (iconBtn) {
        iconBtn.innerHTML = theme === "dark" ? sunIcon : moonIcon;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    let savedTheme = localStorage.getItem("theme");

    // If no theme is saved, use the system preference
    if (!savedTheme) {
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        savedTheme = prefersDark ? "dark" : "light";
    }

    setTheme(savedTheme);

    // Add event listener for the button to toggle theme
    const iconBtn = document.getElementById("theme-icon-button");
    if (iconBtn) {
        iconBtn.addEventListener("click", toggleDarkMode);
    }
});
