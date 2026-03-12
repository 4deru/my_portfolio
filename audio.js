const hoverSound = document.getElementById('hover-audio');
const buttonSound = document.getElementById('button-audio');

// Elements that should play the hover sound
const elements = [
  document.getElementById('hover-contact'),
  document.getElementById('hover-login'),
  document.getElementById('hover-portfolio'),
  document.getElementById('hover-projects') 
];

// Play sound for hoverable elements
elements.forEach(element => {
  if (element) {
    element.addEventListener('click', (event) => {
      event.preventDefault(); 
      hoverSound.currentTime = 0; 
      hoverSound.play().catch(error => {
        console.error('Audio playback failed:', error);
      });

      // Delay navigation by 1 second
      setTimeout(() => {
        window.location.href = element.href; 
      }, 500); 
    });
  }
});

// sound for the login button
const loginButton = document.querySelector('.submit');
if (loginButton) {
  loginButton.addEventListener('click', (event) => {
    event.preventDefault(); 
    buttonSound.currentTime = 0;
    buttonSound.play().catch(error => {
      console.error('Audio playback failed:', error);
    });

    
    setTimeout(() => {
      loginButton.closest('form').submit(); 
    }, 500); 
  });
}

// ...existing code...
