document.addEventListener("DOMContentLoaded", () => {
  const userId = localStorage.getItem("user_id");

  async function carregarCarrossel() {
    const container = document.getElementById("filmes-avaliados");
    container.innerHTML = "<p>Carregando...</p>";

    try {
      const response = await fetch(`../api/review/get.php?user_id=${userId}`);
      const reviews = await response.json();

      container.innerHTML = "";

      if (!reviews.length) {
        container.innerHTML = "<p>Nenhuma análise encontrada.</p>";
        return;
      }

      reviews.forEach(filme => {
        container.innerHTML += `
          <div class="card-small">
            <h4>${filme.movie_name}</h4>
            <p>⭐ ${filme.score}</p>
            <p class="msg">${filme.message || ""}</p>
          </div>
        `;
      });

    } catch (err) {
      console.error("Erro ao carregar análises:", err);
      container.innerHTML = "<p>Erro ao carregar análises.</p>";
    }
  }

  async function carregarDisponiveis() {
    const container = document.getElementById("filmes-disponiveis");
    container.innerHTML = "<p>Carregando...</p>";

    try {
      const response = await fetch(`/api/movies/get_many.php?limit=20`);
      const filmes = await response.json();

      container.innerHTML = "";

      if (!filmes.length || filmes.error) {
        container.innerHTML = "<p>Nenhum filme encontrado.</p>";
        return;
      }

      filmes.forEach(filme => {

        let poster = "img/default.jpg";

        try {
          const imagens = JSON.parse(filme.images);
          if (imagens.length > 0 && imagens[0].content) {
            poster = "data:image/jpeg;base64," + atob(imagens[0].content);
          }
        } catch (e) { }

        container.innerHTML += `
          <div class="card">
            <img src="${poster}">
            <h2>${filme.name}</h2>
            <button class="btn-ver" onclick="avaliarFilme(${filme.id})">
              Avaliar
            </button>
          </div>
        `;
      });

    } catch (err) {
      console.error("Erro ao carregar filmes:", err);
      container.innerHTML = "<p>Erro ao carregar filmes.</p>";
    }
  }

  carregarCarrossel();
  carregarDisponiveis();


  let scrollPos = 0;
  const inner = document.querySelector(".carrossel-inner");

  document.querySelector(".btn-carousel.right").onclick = () => {
    scrollPos += 220;
    inner.style.transform = `translateX(-${scrollPos}px)`;
  };

  document.querySelector(".btn-carousel.left").onclick = () => {
    scrollPos -= 220;
    if (scrollPos < 0) scrollPos = 0;
    inner.style.transform = `translateX(-${scrollPos}px)`;
  };

});

function avaliarFilme(id) {
  window.location.href = `https://seusite.com/avaliar.php?movie=${id}`;
}
