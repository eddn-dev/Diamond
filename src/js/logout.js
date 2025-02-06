(() => {
    // Selecciona todos los enlaces de logout
    const logoutLinks = document.querySelectorAll('.logout-link');
    if (!logoutLinks.length) return;
  
    logoutLinks.forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault(); // Evita la navegación por defecto
  
        fetch('/logout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en el logout');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            // Redirige a la página principal o a donde corresponda
            window.location.href = '/';
          } else {
            console.error('Logout no exitoso');
          }
        })
        .catch(error => {
          console.error('Error en la solicitud de logout:', error);
        });
      });
    });
  })();
  