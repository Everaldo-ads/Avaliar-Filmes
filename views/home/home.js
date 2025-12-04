function getCookie(name) {
  const cookies = document.cookie.split(';');

  for (let cookie of cookies) {
    const [cookieName, cookieValue] = cookie.trim().split('=');
    if (cookieName === name) {
      return decodeURIComponent(cookieValue);
    }
  }
  return null;
}

document.addEventListener("DOMContentLoaded", () => {
  let userId = getCookie('PHPSESSID');

  async function carregarCarrossel() {
    const container = document.getElementById("filmes-avaliados");
    container.innerHTML = "<p>Carregando...</p>";

    if (!userId) {
      container.innerHTML = "<p>Faça login para ver suas análises.</p>";
      return;
    }

    try {
      const response = await fetch(`../api/review/me.php?user_id=${userId}`);

      if (!response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
      }

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
    } catch {
      container.innerHTML = "<p>Erro ao carregar análises.</p>";
    }
  }

  async function carregarDisponiveis() {
    const container = document.getElementById("filmes-disponiveis");
    container.innerHTML = "<p>Carregando...</p>";

    try {
      const response = await fetch(`/api/movies/get_many.php?limit=20`);

      if (response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
      }

      const filmes = await response.json();

      container.innerHTML = "";

      if (!filmes.length || filmes.error) {
        container.innerHTML = "<p>Nenhum filme encontrado.</p>";
        return;
      }

      filmes.forEach(filme => {
        let poster = "../assets/default.jpg";


        const imagens = JSON.parse(filme.images);
        if (imagens.length > 0 && imagens[0].content) {
          poster = "data:image/jpeg;base64," + atob(imagens[0].content);
        }


        container.innerHTML += `
          <div class="card" onclick="abrirFilme(${filme.id})">
            <img src="${poster}" alt="${filme.name}">
            <h2>${filme.name}</h2>
          </div>
        `;
      });

    } catch {
      container.innerHTML = "<p>Erro ao carregar filmes.</p>";
    }
  }

  carregarCarrossel();

  carregarDisponiveis();

  const inner = document.querySelector(".carrossel-inner");

  if (inner) {
    let scrollPos = 0;

    const rightBtn = document.querySelector(".btn-carousel.right");
    const leftBtn = document.querySelector(".btn-carousel.left");

    if (rightBtn) {
      rightBtn.onclick = () => {
        scrollPos += 220;
        inner.style.transform = `translateX(-${scrollPos}px)`;
      };
    }

    if (leftBtn) {
      leftBtn.onclick = () => {
        scrollPos -= 220;
        if (scrollPos < 0) scrollPos = 0;
        inner.style.transform = `translateX(-${scrollPos}px)`;
      };
    }
  }

});

function abrirFilme(id) {
  window.location.href = `../movies/movies.html?id=${id}`;
}