// Este evento garante que o HTML está 100% carregado antes de rodar qualquer script.
document.addEventListener('DOMContentLoaded', function() {

    // =======================================================
    // INICIALIZAÇÃO DAS BIBLIOTECAS DE ANIMAÇÃO E ROLAGEM
    // =======================================================

    try {
        // Inicializa a rolagem suave (Lenis)
        const lenis = new Lenis();
        function raf(time) {
          lenis.raf(time);
          requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Inicializa as animações de aparição (AOS)
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-in-out',
            offset: 50,
        });

    } catch (e) {
        console.error("Erro ao inicializar bibliotecas de animação:", e);
    }

    const form = document.getElementById('leadForm');
    const msg = document.getElementById('msg');

    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch('enviar.php', { // Verifique se o caminho para enviar.php está correto
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                msg.textContent = "Inscrição confirmada! Nos vemos lá.";
                msg.style.color = "var(--amarelo)";
                form.reset();
            })
            .catch(error => {
                console.error('Error:', error);
                msg.textContent = "Houve um erro. Tente novamente.";
                msg.style.color = "red";
            });
        });
    }

});

document.getElementById("topo").onclick = function() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};