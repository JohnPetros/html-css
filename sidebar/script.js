function toggleMenu() {
  const menuMobile = document.getElementById("menu-mobile");

  if (menuMobile.className === "menu-mobile") {
    menuMobile.className = "menu-mobile-active";
  } else {
    menuMobile.className = "menu-mobile";
  }
}
