const hoverSound = document.getElementById('hover-audio');
const buttonSound = document.getElementById('button-audio');


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
