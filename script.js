// ==== Rolagem automática e infinita =====
const carrossel = document.getElementById('carrossel');

// Duplicar cards para simular loop infinito
carrossel.innerHTML += carrossel.innerHTML;

// Velocidade da rolagem automática
let scrollSpeed = 1; 

function autoScroll() {
  carrossel.scrollLeft += scrollSpeed;
  if (carrossel.scrollLeft >= carrossel.scrollWidth / 2) {
    carrossel.scrollLeft = 0;
  }
  requestAnimationFrame(autoScroll);
}
autoScroll();

// Pausa quando o usuário toca ou passa o dedo
let isDown = false;
let startX;
let scrollLeft;

carrossel.addEventListener('mousedown', (e) => {
  isDown = true;
  startX = e.pageX - carrossel.offsetLeft;
  scrollLeft = carrossel.scrollLeft;
});
carrossel.addEventListener('mouseleave', () => { isDown = false; });
carrossel.addEventListener('mouseup', () => { isDown = false; });
carrossel.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - carrossel.offsetLeft;
  const walk = (x - startX) * 2; 
  carrossel.scrollLeft = scrollLeft - walk;
});

// Suporte ao toque (mobile)
let touchStartX = 0;
carrossel.addEventListener('touchstart', (e) => {
  touchStartX = e.touches[0].clientX;
});
carrossel.addEventListener('touchmove', (e) => {
  const touchX = e.touches[0].clientX;
  const walk = (touchX - touchStartX) * 1.5;
  carrossel.scrollLeft -= walk;
  touchStartX = touchX;
});

const form = document.getElementById('leadForm');
const msg = document.getElementById('msg');

form.addEventListener('submit', function(e) {
    e.preventDefault(); // evita recarregar a página

    const formData = new FormData(form);

    fetch('enviar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        msg.textContent = "Lead enviado com sucesso!";
        msg.style.color = "green";
        form.reset(); // limpa os campos
    })
    .catch(error => {
        msg.textContent = "Houve um erro. Tente novamente.";
        msg.style.color = "red";
    });
});
