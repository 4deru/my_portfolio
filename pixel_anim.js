const createPixel = () => {
    const pixel = document.createElement('div');
    pixel.classList.add('pixel');
    pixel.style.left = `${Math.random() * 100}vw`;
    pixel.style.backgroundColor = getRandomColor();
    pixel.style.animationDuration = `${Math.random() * 3 + 3}s`;
    document.body.appendChild(pixel);
  
    setTimeout(() => pixel.remove(), 10000);
  };
  
  const getRandomColor = () => {
    const colors = ['#112244', '#5770a4'];
    return colors[Math.floor(Math.random() * colors.length)];
  };
  
  setInterval(createPixel, 100);
  