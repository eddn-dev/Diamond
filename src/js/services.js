(() => {
    const cards = document.querySelectorAll('.service-card__image-container');
    if (!cards.length) return;
  
    cards.forEach(card => {
      let images;
      try {
        images = JSON.parse(card.getAttribute('data-images'));
      } catch (e) {
        console.error('Error parsing images for card', card);
        return;
      }
      if (!Array.isArray(images) || images.length === 0) return;
  
      const imgElement = card.querySelector('.service-card__image');
      if (!imgElement) return;
  
      let current = 0;
      setInterval(() => {
        current = (current + 1) % images.length;
        const tempImg = document.createElement('img');
        tempImg.src = images[current];
        tempImg.alt = imgElement.alt;
        tempImg.className = 'service-card__image temp';
        tempImg.style.position = 'absolute';
        tempImg.style.top = 0;
        tempImg.style.left = 0;
        tempImg.style.width = '100%';
        tempImg.style.height = '100%';
        tempImg.style.objectFit = 'cover';
        tempImg.style.opacity = 0;
        tempImg.style.transition = 'opacity 0.5s ease';
  
        card.appendChild(tempImg);
        void tempImg.offsetWidth;
        tempImg.style.opacity = 1;
  
        tempImg.addEventListener('transitionend', () => {
          imgElement.src = images[current];
          card.removeChild(tempImg);
        });
      }, 3000);
    });
  })();
  