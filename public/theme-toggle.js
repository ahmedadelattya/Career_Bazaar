function setTheme(theme) {
  document.documentElement.classList.toggle("dark", theme === "dark");
  localStorage.setItem("theme", theme);
}

function toggleDarkMode() {
  const currentTheme =
    localStorage.getItem("theme") === "dark" ? "light" : "dark";
  setTheme(currentTheme);
}

document.addEventListener("DOMContentLoaded", () => {
  let savedTheme = localStorage.getItem("theme");

  // If no theme is saved, use the system preference
  if (!savedTheme) {
    const prefersDark = window.matchMedia(
      "(prefers-color-scheme: dark)",
    ).matches;
    savedTheme = prefersDark ? "dark" : "light";
  }

  setTheme(savedTheme);
});
