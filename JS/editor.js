const sidebarElem = document.getElementById("sidebar");

document.getElementById("btn-collapse").addEventListener("click", () => {
  sidebarElem.classList.toggle("collapsed");
});

document.getElementById("btn-toggle").addEventListener("click", () => {
  sidebarElem.classList.toggle("toggled");
});

document.getElementById("overlay").addEventListener("click", () => {
  sidebarElem.classList.toggle("toggled");
});

document.getElementById("btn-rtl").addEventListener("click", () => {
  document.getElementById("layout-container").classList.toggle("rtl");
});