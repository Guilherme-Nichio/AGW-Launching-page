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
                const redirectURL = 'https://chat.whatsapp.com/DGI7K2R7WeuLlzfC6PtWzi?mode=wwc';
                window.location.href = redirectURL;
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



document.getElementById("phone").addEventListener("input", function (e) {
    let valor = e.target.value.replace(/\D/g, ""); // remove tudo que não é número

    // aplica a máscara automaticamente
    if (valor.length > 10) {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (valor.length > 6) {
        valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (valor.length > 2) {
        valor = valor.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
    } else {
        valor = valor.replace(/^(\d*)/, "($1");
    }

    e.target.value = valor;
});
