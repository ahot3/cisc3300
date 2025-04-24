document.addEventListener('DOMContentLoaded', function() {
  const carouselEl = document.querySelector('#homeCarousel');
  if (carouselEl) {
    const carousel = new bootstrap.Carousel(carouselEl, {
      interval: 6000,
      ride: 'carousel',
      pause: 'hover'
    });
  }
  
  const navbar = document.getElementById('mainNav');
  
  function handleNavbarScroll() {
    if (window.scrollY > 50) {
      navbar.classList.add('navbar-shrink');
    } else {
      navbar.classList.remove('navbar-shrink');
    }
  }
  
  handleNavbarScroll();
  
  window.addEventListener('scroll', handleNavbarScroll);
  
  const newsletterForm = document.getElementById('newsletter-form');
  if (newsletterForm) {
    console.log('Homepage newsletter form found');
    newsletterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      console.log('Newsletter form submitted from homepage');
      
      const email = document.getElementById('newsletter-email').value;
      const name = document.getElementById('newsletter-name') ? 
                   document.getElementById('newsletter-name').value || '' : 
                   '';
      const feedback = document.getElementById('newsletter-feedback');
      
      console.log('Newsletter data:', { email, name });
      console.log('Newsletter feedback element:', feedback);
      
      fetch('/api/newsletter', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          email: email,
          name: name
        })
      })
      .then(response => {
        console.log('Newsletter response status:', response.status);
        if (!response.ok) {
          return response.json().then(data => {
            console.error('Newsletter error data:', data);
            throw new Error(data.error || 'Failed to subscribe');
          });
        }
        return response.json();
      })
      .then(data => {
        console.log('Newsletter success data:', data);
        if (feedback) {
          feedback.textContent = 'Thank you for subscribing to our newsletter!';
          feedback.className = 'mt-2 small text-success';
        } else {
          alert('Thank you for subscribing! You\'ll receive our latest travel updates soon.');
        }
        newsletterForm.reset();
      })
      .catch(error => {
        console.error('Newsletter error:', error);
        if (feedback) {
          feedback.textContent = error.message || 'Failed to subscribe. Please try again later.';
          feedback.className = 'mt-2 small text-danger';
        } else {
          alert('Error: ' + (error.message || 'Failed to subscribe. Please try again later.'));
        }
      });
    });
  }
  
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const targetId = this.getAttribute('href');
      
      if (targetId !== '#' && document.querySelector(targetId)) {
        e.preventDefault();
        
        document.querySelector(targetId).scrollIntoView({
          behavior: 'smooth'
        });
      }
    });
  });
  
  const imageContainers = document.querySelectorAll('.image-container');
  imageContainers.forEach(container => {
    if (container) {
      container.setAttribute('tabindex', '0');
      
      container.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          this.click();
        }
      });
    }
  });
  
  function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }
});