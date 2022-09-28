const card = document.querySelector('#card');
const flip = () => {
    card.classList.toggle('flip');
}

card.addEventListener('click', flip);