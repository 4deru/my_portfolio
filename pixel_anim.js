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
    const colors = ['#C8BDDB', '#D4D4ED', '#BBA0CA', '#C087BD', '#AF5A97'];
    return colors[Math.floor(Math.random() * colors.length)];
  };
  
  setInterval(createPixel, 10);
  