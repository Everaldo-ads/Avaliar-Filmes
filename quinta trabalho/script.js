function addMovie() {
  const title = document.getElementById("title").value;
  const poster = document.getElementById("poster").value;
  const rating = document.getElementById("rating").value;
  const review = document.getElementById("review").value;

  if (!title || !poster || !rating || !review) {
    alert("Por favor, preencha todos os campos!");
    return;
  }

  const moviesList = document.getElementById("moviesList");

  const card = document.createElement("div");
  card.classList.add("card");

  card.innerHTML = `
    <img src="${poster}" />
    <h2>${title}</h2>
    <div class="rating">⭐ ${rating}</div>
    <p class="review">${review}</p>
  `;

  moviesList.appendChild(card);

  document.getElementById("title").value = "";
  document.getElementById("poster").value = "";
  document.getElementById("rating").value = "";
  document.getElementById("review").value = "";
}
