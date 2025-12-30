 // image or video preview in upload box code------------------------

 document.getElementById('fileInput').addEventListener('change', function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('previewContainer');
  
    previewContainer.innerHTML = '';
    Array.from(files).forEach(file => {
      const fileURL = URL.createObjectURL(file);
      const fileType = file.type;
  
      if (fileType.startsWith('image/')) {
        const img = document.createElement('img');
        img.src = fileURL;
        img.style.maxWidth = '120px'; 
        img.style.height = '100px'; 
        img.style.margin = '10px';
        previewContainer.appendChild(img);
      } else if (fileType.startsWith('video/')) {
        const video = document.createElement('video');
        video.src = fileURL;
        video.controls = true;
        video.style.maxWidth = '120px';
        video.style.height = '100px';
        video.style.margin = '10px';
        previewContainer.appendChild(video);
      }
    });
  });
  
//   lightbox js------------------
  const lightbox = document.getElementById('lightbox');
          const lightboxImage = lightbox.querySelector('img');
          const images = document.querySelectorAll('.event-box img');
          const closeBtn = lightbox.querySelector('.close');
          const prevBtn = lightbox.querySelector('.prev');
          const nextBtn = lightbox.querySelector('.next');
  
          let currentIndex = 0;
  
          function showLightbox(index) {
              currentIndex = index;
              lightboxImage.src = images[currentIndex].src;
              lightbox.style.display = 'flex';
          }
  
          function hideLightbox() {
              lightbox.style.display = 'none';
          }
  
          function showNextImage() {
              currentIndex = (currentIndex + 1) % images.length;
              lightboxImage.src = images[currentIndex].src;
          }
  
          function showPrevImage() {
              currentIndex = (currentIndex - 1 + images.length) % images.length;
              lightboxImage.src = images[currentIndex].src;
          }
  
          images.forEach((img, index) => {
              img.addEventListener('click', () => showLightbox(index));
          });
  
          closeBtn.addEventListener('click', hideLightbox);
          nextBtn.addEventListener('click', showNextImage);
          prevBtn.addEventListener('click', showPrevImage);
  
          lightbox.addEventListener('click', (e) => {
              if (e.target === lightbox) hideLightbox();
          });