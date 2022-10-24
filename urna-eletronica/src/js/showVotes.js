const table = document.querySelector(".votes-table");
const exitButton = document.querySelector(".final-message");

const getVotes = () => JSON.parse(localStorage.getItem("votes")) ?? [];

function showVotes() {
  const votes = getVotes();
  console.log(votes);
  let vote = "";
  for (let candidate of votes) {
    // console.log("oi");
    if (candidate.vote !== "BRANCO") {
      vote += `
        <div class="vote">
          <p class="role">${candidate.role}:</p>
          <div class="candidate-information">
            <img src="${candidate.vote.image}" alt="Foto do candidato votado" />
            <div>
                <p>${candidate.vote.name}</p>
                <p>${candidate.vote.party}</p>
                <p>Número: ${candidate.vote.number}</p>
            </div>
          </div>
        </div>
        `;
    } else {
      vote += `
      <div class="vote">
          <p class="role">${candidate.role}:</p>
          <div class="candidate-information">
            VOTO EM BRANCO
        </div>
        </div>
      `;
    }
  }
  // console.log(vote);
  table.innerHTML += vote;
}

function exit() {
  localStorage.removeItem("votes");
  location.href = "../../index.php";
}

showVotes();
