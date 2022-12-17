let isIgnite = true;
function changeCard(event) {
  const card = event.target;
  const bg = isIgnite ? "explorer" : "ignite";
  isIgnite = !isIgnite;
  card.style.background = `url(".assets/bg-${bg}.svg")`;
}