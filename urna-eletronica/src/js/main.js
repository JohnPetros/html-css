const form = document.querySelector("form");
const url = document.querySelector("input[name=url]").value;
const display = document.querySelector(".display");
const header = document.querySelector(".header");
const roleTitle = document.querySelector(".role-title");
const information = document.querySelector(".information");
const footer = document.querySelector("footer");
const aside = document.querySelector(".right-side");
const digits = document.querySelector(".digits");
const buttons = document.querySelectorAll("button");
const partiesTable = document.querySelector(".parties-table");
const candidatesTable = document.querySelectorAll(".candidates-table");
const parties = document.querySelectorAll(".party");
const closeButton = document.querySelector(".close");
const roleIdInput = document.querySelector("input[name=role-id]");
const keySound = document.querySelector("#key-sound");
const confirmSound = document.querySelector("#confirm-sound");
let roleId = roleIdInput.value;
let roles;
let role;
let number = "";
let whiteVote = false;
let votes = [];
console.log(roleId);

const updateVotes = (votes) =>
  localStorage.setItem("votes", JSON.stringify(votes));

const getVotes = () => JSON.parse(localStorage.getItem("votes")) ?? [];

function hideElements(...elements) {
  elements.forEach((element) => element.classList.add("hide"));
}
function showElements(...elements) {
  elements.forEach((element) => element.classList.remove("hide"));
}

function insertIntoElement(element, content) {
  element.innerHTML = content;
}

async function getCurrentRole(roleId) {
  const response = await fetch(url);
  roles = await response.json();
  return roles[roleId];
}

async function init() {
  role = await getCurrentRole(roleId);
  console.log(role);
  startVoting();
}

async function startVoting() {
  console.log("dígitos: " + role.digits);

  let digitsHTML = "";
  number = "";
  whiteVote = false;

  for (let i = 0; i <= role.digits - 1; i++) {
    const isFirstDigit = i === 0 ? "blink" : "";
    digitsHTML += `<input class="digit ${isFirstDigit}" type="text" readonly>`;
  }

  hideElements(header, information, footer, aside);
  showElements(digits);
  insertIntoElement(roleTitle, role.title);
  insertIntoElement(digits, digitsHTML);
}

function insertInformationCandidateIntoDisplay(candidate) {
  let informationCandidate = `<p id="name">Nome: ${candidate.name}</p> <p id="party">Partido: ${candidate.party}</p>`;
  if (candidate.alternates) {
    for (let alternate in candidate.alternates) {
      const alternateName = candidate.alternates[alternate];
      const alternateRoleName = candidate.images[++alternate].caption;
      informationCandidate += `<p>${alternateRoleName}: ${alternateName}</p>`;
    }
  }
  insertIntoElement(information, informationCandidate);
  showElements(information);
}

function insertImagesIntoDisplay(candidate) {
  let imagesHTML = "";
  let imagesSmallHTML = '<div class="images-small-container">';
  for (let image in candidate.images) {
    if (candidate.images[image].small) {
      imagesSmallHTML += `
            <div  class="image small">
                <img
                  class="small-image"
                  src="${candidate.images[image].url}"
                  />
                  ${candidate.images[image].caption}
            </div>`;
    } else {
      imagesHTML += `
              <div class="image">
                  <img
                    id="image"
                    src="${candidate.images[image].url}"
                    />
                    ${candidate.images[image].caption}
              </div>`;
    }
  }
  imagesHTML += imagesSmallHTML + "</div>";
  insertIntoElement(aside, imagesHTML);
  showElements(aside);
}

function insertWarning() {
  const warning = `<div class="warning blink">VOTO NULO</div>`;
  insertIntoElement(information, warning);
  showElements(information);
}

function updateDisplay() {
  let candidate = role.candidates.filter(
    (candidate) => candidate.number === number
  );

  const candidateExists = candidate.length > 0;
  showElements(header, footer);
  if (candidateExists) {
    candidate = candidate[0];

    insertInformationCandidateIntoDisplay(candidate);
    insertImagesIntoDisplay(candidate);
  } else {
    insertWarning();
  }
}

function insertNumber(num) {
  const blinkField = document.querySelector(".digit.blink");
  if (blinkField) {
    blinkField.value = num;
    number = `${number}${num}`;

    blinkField.classList.remove("blink");
    if (blinkField.nextElementSibling) {
      blinkField.nextElementSibling.classList.add("blink");
    } else {
      updateDisplay();
    }
  }
}

function nullNumber() {
  if (!number) {
    whiteVote = true;
    hideElements(header, footer, digits);
    insertWarning();
  } else {
    Swal.fire({
      icon: "error",
      title: "Para votar em BRANCO, o campo de voto deve estar vazio.",
      text: "Aperte CORRIGE para apagar o campo de voto.",
      width: "44rem",
    });
  }
}

function showVotes() {
  location.href = "./votes.php";
}

function finishVoting() {
  const warning = '<div class="warning bigger blink">FIM</div>';
  insertIntoElement(display, warning);
  buttons.forEach((button) => (button.style.pointerEvents = "none"));
  const finalMessage = document.querySelector(".final-message");
  showElements(finalMessage);
  finalMessage.addEventListener("click", showVotes);
}

function recordVote() {
  votes = getVotes(votes);
  if (whiteVote) {
    alert("branco");
    votes.push({
      role: roles[roleId].title,
      vote: "BRANCO",
    });
    console.log("Confirmando como BRANCO...");
  } else if (number.length === role.digits) {
    if (!document.getElementById("name")) {
      votes.push({
        role: roles[roleId].title,
        vote: "BRANCO",
      });
    } else {
      const name = document.getElementById("name").textContent;
      const party = document.getElementById("party").textContent;
      const image = document.getElementById("image").src;
      const smallImages = document.querySelectorAll(".small-image").src;
      const number_ = number;
      votes.push({
        role: roles[roleId].title,
        vote: {
          name: name,
          image: image,
          party: party,
          smallImages: smallImages ?? null,
          number: number_,
        },
      });
    }
  }
  updateVotes(votes);
}

function confirmVote() {
  alert(role.digits);
  if (!whiteVote && number.length !== role.digits) {
    Swal.fire({
      icon: "error",
      title: "Para votar, o campo de voto deve estar completo.",
      text: "Insira o dígitos pressionando as teclas numéricas.",
      width: "44rem",
    });
    return;
  }

  recordVote();
  console.log(votes);

  roleId++;
  confirmSound.play();
  if (roles[roleId]) {
    roleIdInput.value = roleId;
    form.submit();
  } else {
    finishVoting();
  }
}

function handleButton(event) {
  const button = event.target;
  if (button.hasAttribute("data-number")) {
    const number = Number(button.textContent);
    insertNumber(number);
  } else if (button.hasAttribute("data-white")) {
    nullNumber();
  } else if (button.hasAttribute("data-correct")) {
    startVoting();
  } else {
    confirmVote();
  }
  keySound.play();
}

function chooseParty(event) {
  partiesTable.classList.add("remove");
  console.log(event.target);
  const chosenParty = event.target.parentNode.id;
  const chosenCandidatesTable = document.querySelector(
    `.candidates-table.${chosenParty}`
  );
  console.log(chosenParty);
  console.log(chosenCandidatesTable);
  chosenCandidatesTable.classList.remove("remove");
  closeButton.classList.remove("remove");
}

function closeCandidatesTable() {
  partiesTable.classList.remove("remove");
  candidatesTable.forEach((table) => table.classList.add("remove"));
  closeButton.classList.add("remove");
}

buttons.forEach((button) => button.addEventListener("click", handleButton));
parties.forEach((partie) => partie.addEventListener("click", chooseParty));
init();
closeButton.addEventListener("click", closeCandidatesTable);
