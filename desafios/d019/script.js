const button = document.querySelector('button');
const modal = document.getElementById('modal');

button.addEventListener('click', function(){
    modal.classList.remove('invisibled')
    button.classList.add('invisibled')
})

document.addEventListener('keydown', function(event) {
    if ((event.key == 'Escape') && (modal.hasAttribute('class'))) {
        modal.classList.add('invisibled')
        button.classList.remove('invisibled') 
    }
})




// function openModal() {
//     const modal = document.getElementById('modal')
//     modal.removeAttribute('class')
//     document.querySelector('button').setAttribute('class', 'invisibled')
// }

// document.addEventListener('keydown', closeModal)

// function closeModal(event) {
//     const modal = document.getElementById('modal')
//     if (event.keyCode == 27) {
//         modal.classList.add('invisibled')
//         document.querySelector('button').classList.remove('invisibled')
//     }
// }