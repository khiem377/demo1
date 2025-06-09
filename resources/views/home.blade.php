@extends('layouts.app')

@section('content')
<div class="banner-container">
  <div class="slider-wrapper">
    <div class="slider-track" id="sliderTrack">
      @if(isset($banners) && count($banners) > 0)
        @foreach ($banners as $index => $banner)
          <div class="slide {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ $banner }}" alt="Banner {{ $index + 1 }}">
          </div>
        @endforeach
      @else
        <div class="slide active">
          <div class="no-banner">
            <p>No banners available</p>
          </div>
        </div>
      @endif
    </div>
    
    <!-- Navigation buttons -->
    <button class="nav-btn prev-btn" id="prevBtn" aria-label="Previous slide">
      <span>‹</span>
    </button>
    <button class="nav-btn next-btn" id="nextBtn" aria-label="Next slide">
      <span>›</span>
    </button>
    
    <!-- Pagination dots -->
    <div class="pagination" id="pagination"></div>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const sliderTrack = document.getElementById('sliderTrack');
  const slides = document.querySelectorAll('.slide');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const pagination = document.getElementById('pagination');
  
  let currentSlide = 0;
  let totalSlides = slides.length;
  let autoplayInterval;
  let isTransitioning = false;
  
  // Khởi tạo slider
  function initSlider() {
    if (totalSlides === 0) return;
    
    // Tạo pagination dots
    createPaginationDots();
    
    // Cập nhật vị trí ban đầu
    updateSliderPosition();
    
    // Bắt đầu autoplay
    startAutoplay();
    
    // Event listeners
    addEventListeners();
    
    console.log('Vanilla JS Slider initialized with', totalSlides, 'slides');
  }
  
  // Tạo pagination dots
  function createPaginationDots() {
    pagination.innerHTML = '';
    
    for (let i = 0; i < totalSlides; i++) {
      const dot = document.createElement('span');
      dot.classList.add('dot');
      if (i === 0) dot.classList.add('active');
      dot.addEventListener('click', () => goToSlide(i));
      pagination.appendChild(dot);
    }
  }
  
  console.log('Slider HTML:', sliderTrack.innerHTML);
console.log('Slider Width:', sliderTrack.offsetWidth);
slides.forEach((s, i) => {
  console.log(`Slide ${i} width:`, s.offsetWidth);
});

  // Cập nhật vị trí slider
  function updateSliderPosition(animate = true) {
    if (isTransitioning) return;
    
    isTransitioning = true;
    
    // Tính toán transform
    const translateX = -currentSlide * 100;
    
    // Áp dụng transition nếu animate = true
    if (animate) {
      sliderTrack.style.transition = 'transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
    } else {
      sliderTrack.style.transition = 'none';
    }
    
    sliderTrack.style.transform = `translateX(${translateX}%)`;
    
    // Cập nhật active states
    updateActiveStates();
    
    // Reset transition flag sau khi animation hoàn thành
    setTimeout(() => {
      isTransitioning = false;
    }, animate ? 800 : 0);
  }
  
  // Cập nhật active states
  function updateActiveStates() {
    // Slides
    slides.forEach((slide, index) => {
      slide.classList.toggle('active', index === currentSlide);
    });
    
    // Pagination dots
    const dots = pagination.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === currentSlide);
    });
  }
  
  // Chuyển đến slide cụ thể
  function goToSlide(index, animate = true) {
    if (index < 0 || index >= totalSlides || index === currentSlide) return;
    
    currentSlide = index;
    updateSliderPosition(animate);
    
    console.log('Slide changed to:', currentSlide);
  }
  
  // Slide tiếp theo
  function nextSlide() {
    const nextIndex = (currentSlide + 1) % totalSlides;
    goToSlide(nextIndex);
  }
  
  // Slide trước đó
  function prevSlide() {
    const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
    goToSlide(prevIndex);
  }
  
  // Bắt đầu autoplay
  function startAutoplay() {
    if (totalSlides <= 1) return;
    
    autoplayInterval = setInterval(() => {
      nextSlide();
    }, 4000);
    
    console.log('Autoplay started - 4s interval');
  }
  
  // Dừng autoplay
  function stopAutoplay() {
    if (autoplayInterval) {
      clearInterval(autoplayInterval);
      autoplayInterval = null;
    }
  }
  
  // Khởi động lại autoplay
  function restartAutoplay() {
    stopAutoplay();
    setTimeout(startAutoplay, 500);
  }
  
  // Thêm event listeners
  function addEventListeners() {
    // Navigation buttons
    prevBtn.addEventListener('click', () => {
      prevSlide();
      restartAutoplay();
    });
    
    nextBtn.addEventListener('click', () => {
      nextSlide();
      restartAutoplay();
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        prevSlide();
        restartAutoplay();
      } else if (e.key === 'ArrowRight') {
        nextSlide();
        restartAutoplay();
      }
    });
    
    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    sliderTrack.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
      stopAutoplay();
    });
    
    sliderTrack.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
      restartAutoplay();
    });
    
    function handleSwipe() {
      const swipeThreshold = 50;
      const diff = touchStartX - touchEndX;
      
      if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
          nextSlide(); // Swipe left - next slide
        } else {
          prevSlide(); // Swipe right - prev slide
        }
      }
    }
    
    // Pause on hover
    const container = document.querySelector('.banner-container');
    container.addEventListener('mouseenter', stopAutoplay);
    container.addEventListener('mouseleave', startAutoplay);
    
    // Visibility API - pause when tab not active
    document.addEventListener('visibilitychange', () => {
      if (document.hidden) {
        stopAutoplay();
      } else {
        startAutoplay();
      }
    });
  }
  
  // Test manual slide
  setTimeout(() => {
    console.log('Testing manual slide...');
    nextSlide();
  }, 2000);
  
  // Khởi tạo slider
  initSlider();
});
</script>

<style>
/* Banner Container */
.banner-container {
  width: 100%;
  height: 300px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background: #f0f0f0;
}

/* Slider Wrapper */
.slider-wrapper {
  width: 100%;
  height: 100%;
  position: relative;
}

/* Slider Track */
.slider-track {
  display: flex;
  flex-direction: row;
  width: 100%;
  height: 100%;
}



/* Slides */
.slide {
  min-width: 100%;
  flex-shrink: 0;
}


.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.no-banner {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f0f0f0;
  color: #666;
  font-size: 16px;
}

/* Navigation Buttons */
.nav-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 44px;
  height: 44px;
  background: rgba(0, 0, 0, 0.5);
  border: none;
  border-radius: 50%;
  color: white;
  font-size: 24px;
  cursor: pointer;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  user-select: none;
}

.nav-btn:hover {
  background: rgba(0, 0, 0, 0.7);
  transform: translateY(-50%) scale(1.1);
}

.nav-btn:active {
  transform: translateY(-50%) scale(0.95);
}

.prev-btn {
  left: 10px;
}

.next-btn {
  right: 10px;
}

.nav-btn span {
  line-height: 1;
  font-weight: bold;
}

/* Pagination */
.pagination {
  position: absolute;
  bottom: 15px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  z-index: 10;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.dot:hover {
  background: rgba(255, 255, 255, 0.8);
  transform: scale(1.2);
}

.dot.active {
  background: white;
  border-color: rgba(0, 0, 0, 0.2);
  transform: scale(1.3);
}

/* Responsive Design */
@media (max-width: 768px) {
  .banner-container {
    height: 200px;
  }
  
  .nav-btn {
    width: 36px;
    height: 36px;
    font-size: 18px;
  }
  
  .prev-btn {
    left: 5px;
  }
  
  .next-btn {
    right: 5px;
  }
  
  .pagination {
    bottom: 10px;
  }
  
  .dot {
    width: 10px;
    height: 10px;
  }
}

@media (max-width: 480px) {
  .banner-container {
    height: 180px;
    border-radius: 4px;
  }
  
  .nav-btn {
    width: 32px;
    height: 32px;
    font-size: 16px;
  }
  
  .dot {
    width: 8px;
    height: 8px;
  }
  
  .pagination {
    gap: 6px;
  }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  .slider-track {
    transition: none !important;
  }
  
  .nav-btn,
  .dot {
    transition: none !important;
  }
}

/* Focus styles for accessibility */
.nav-btn:focus,
.dot:focus {
  outline: 2px solid #fff;
  outline-offset: 2px;
}

/* Loading state */
.slide img {
  opacity: 0;
  transition: opacity 0.3s ease;
}

.slide img.loaded,
.slide.active img {
  opacity: 1;
}
</style>
@endsection