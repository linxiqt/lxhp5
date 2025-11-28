class ComponentController {
  constructor() {
    this.initComponents();
  }

  elementExists(selector) {
    return !!document.querySelector(selector);
  }

  initComponents() {
    this.handleCarousel();
    this.handleLazyLoad();
    this.handleSubmenu();
    this.handleScrollButtons();
    this.handleThemeToggle();
    this.handleClocks();
    this.handleAudioControl();
    this.handleBlurEffect();
    this.handleHeaderScroll();
    this.handleFriendForm();
    this.handleTextEffects();
    this.handleSidebarMenu();
    this.handelSwitchSidebar();
    this.handleShareButton();
    this.handleF12();
    this.handle_code_highlight();
    this.handel_code_copy();

  }
  // 初始化复制代码按钮
  handel_code_copy() {
    const copyButtons = document.querySelectorAll('.copy-btn');
    copyButtons.forEach(button => {
      button.addEventListener('click', () => {
        const codeElement = button.parentElement.nextElementSibling.querySelector('code');
        if (!codeElement) {
          console.error('未找到代码块');
          return;
        }
        const code = codeElement.innerText;
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(code).then(() => {
            button.textContent = '已复制';

            setTimeout(() => button.textContent = '复制', 2000);
          }).catch(err => {
            console.error('复制失败:', err);
            button.textContent = '复制失败';
          });
        } else {
          // 回退方案：手动创建 textarea 进行复制
          const textArea = document.createElement('textarea');
          textArea.value = code;
          document.body.appendChild(textArea);
          textArea.select();
          try {
            document.execCommand('copy');
            button.textContent = '已复制';

          } catch (err) {
            console.error('回退复制失败:', err);
            button.textContent = '复制失败';
          }
          document.body.removeChild(textArea);
        }
      });
    });
  }
  handle_code_highlight() {
    window.hljs && hljs.highlightAll();
  }
  handleF12() {
    // 禁用键盘快捷键
    document.addEventListener('keydown', function (e) {
      // 检测 F12
      if (e.keyCode === 123) {
        blockEvent(e);
      }
      // 检测 Ctrl+Shift+I
      else if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
        blockEvent(e);
      }
      // 检测 Ctrl+Shift+J
      else if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
        blockEvent(e);
      }
      // 检测 Ctrl+Shift+C
      else if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
        blockEvent(e);
      }
      // 检测 Ctrl+U
      else if (e.ctrlKey && e.keyCode === 85) {
        blockEvent(e);
      }
    });

    function blockEvent(e) {
      e.preventDefault();
      e.stopPropagation();
      e.returnValue = false;
      return false;
    }

  }
  handleCarousel() {
    if (!this.elementExists('.carousel')) return;

    class CardCarousel {
      constructor(container) {
        this.carousel = container;
        this.slides = container.querySelector('.slides');
        this.dotsContainer = container.querySelector('.dots');
        this.slidesCount = container.querySelectorAll('.slide').length;
        this.currentIndex = 0;
        this.autoPlayInterval = null;
        this.textslide = container.querySelectorAll('.text-slide')


        this.initDots();
        this.addEventListeners();
        this.update();
        this.startAutoPlay();
      }

      initDots() {
        this.dotsContainer.innerHTML = '';
        for (let i = 0; i < this.slidesCount; i++) {
          const dot = document.createElement('button');
          dot.className = 'dot' + (i === 0 ? ' active' : '');
          dot.addEventListener('click', () => {
            this.goTo(i);
            this.stopAutoPlay();
            this.startAutoPlay();
          });
          this.dotsContainer.appendChild(dot);
        }
      }


      update() {
        const isMobile = window.innerWidth < 1400;
        const dimension = isMobile ? this.carousel.offsetWidth : this.carousel.offsetHeight;
        const transformValue = isMobile ?
          `translateX(-${this.currentIndex * dimension}px)` :
          `translateY(-${this.currentIndex * dimension}px)`;

        this.slides.style.transform = transformValue;
        this.dotsContainer.querySelectorAll('.dot').forEach((dot, i) => {
          dot.classList.toggle('active', i === this.currentIndex);
        });
        for (let i = 0; i < this.textslide.length; i++) {
          this.textslide[i].classList.remove('active')
        }

        this.textslide[this.currentIndex].classList.add('active');
      }

      goTo(index) {
        this.currentIndex = index;
        this.update();
      }

      nextSlide() {
        this.currentIndex = (this.currentIndex + 1) % this.slidesCount;
        this.update();
      }

      startAutoPlay() {
        this.stopAutoPlay(); // 确保清除之前的定时器
        this.autoPlayInterval = setInterval(() => {
          this.nextSlide();
        }, 3000);
      }

      stopAutoPlay() {
        if (this.autoPlayInterval) {
          clearInterval(this.autoPlayInterval);
          this.autoPlayInterval = null;
        }
      }

      addEventListeners() {
        let startY = 0;
        let startX = 0;
        let isScrolling = false;

        this.carousel.addEventListener('touchstart', e => {
          startX = e.touches[0].clientX;
          startY = e.touches[0].clientY;
          this.stopAutoPlay(); // 触摸开始暂停自动播放
        });

        this.carousel.addEventListener('touchmove', e => {
          if (!isScrolling) {
            const xDiff = Math.abs(e.touches[0].clientX - startX);
            const yDiff = Math.abs(e.touches[0].clientY - startY);
            isScrolling = xDiff > yDiff;
          }
        });

        this.carousel.addEventListener('touchend', e => {
          const endX = e.changedTouches[0].clientX;
          const endY = e.changedTouches[0].clientY;
          const isMobile = window.innerWidth < 1400;

          if (isMobile) {
            const diffX = startX - endX;
            if (Math.abs(diffX) > 30) {
              this.currentIndex = diffX > 0 ?
                Math.min(this.currentIndex + 1, this.slidesCount - 1) :
                Math.max(this.currentIndex - 1, 0);
              this.update();
            }
          } else {
            const diffY = startY - endY;
            if (Math.abs(diffY) > 30 && !isScrolling) {
              this.currentIndex = diffY > 0 ?
                Math.min(this.currentIndex + 1, this.slidesCount - 1) :
                Math.max(this.currentIndex - 1, 0);
              this.update();
            }
          }

          isScrolling = false;
          this.startAutoPlay(); // 触摸结束重启自动播放
        });
      }
    }

    new CardCarousel(document.querySelector('.carousel'));
  }

  handleLazyLoad() {
    if (!this.elementExists('img.lazy')) return;
    $("img.lazy").lazyload({ placeholder: lazylaodimg });
  }

  handleSubmenu() {
    if (!this.elementExists('.has-submenu')) return;
    document.querySelectorAll('.has-submenu').forEach(item => {
      item.addEventListener('click', function (e) {
        e.stopPropagation();
        this.classList.toggle('active');
      });
    });
  }



  handleShareButton() {
    if (!this.elementExists('.share')) return;
    const button = document.querySelector('.share')

    button.addEventListener('click', () => {
      const text = window.location.href;
      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
          alert('复制成功')
        }).catch(err => {
          console.error('复制失败:', err);
        });
      } else {
        // 回退方案：手动创建 textarea 进行复制
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
          document.execCommand('copy');
          alert('复制成功')
        } catch (err) {
          console.error('回退复制失败:', err);
        }
        document.body.removeChild(textArea);
      }
    })
  }


  handleThemeToggle() {
    if (!this.elementExists('.day_night')) return;

    Qmsg.config({
      showClose: true,
      timeout: 5000,
      position: 'right',
      maxNums: 1,
      html: true
    })
    const themeButton = document.querySelector('.day_night');
    themeButton.addEventListener('click', () => {
      const html = document.documentElement;
      html.classList.toggle("Dark");
      if (html.classList.contains('Dark')) {
        Qmsg.success('<p style="color:#000000;margin-bottom:5px;">关灯了🌙</p><p style="color:#555555;">当前已成功切换至黑夜模式！</p>');
      } else {
        Qmsg.success('<p style="color:#000000;margin-bottom:5px;">开灯了🌞</p><p style="color:#555555;">当前已成功切换至白天模式！</p>');

      }
      this.setCookie("themeState", html.classList.contains('Dark') ? "Dark" : "Light", 1);
    });
    if (this.getCookie("themeState") === "Dark") document.documentElement.classList.add("Dark");
  }

  handleClocks() {
    const hourHand = document.querySelector('.hour-hand');
    const clockTime = document.getElementById('clock-time');
    const clockDate = document.getElementById('clock-date');

    if (hourHand) {
      const updateAnalogClock = () => {
        const now = new Date();
        const hourAngle = (now.getHours() % 12) * 30 + (now.getMinutes() / 2);
        const minuteAngle = now.getMinutes() * 6 + (now.getSeconds() / 10);
        const secondAngle = now.getSeconds() * 6;
        hourHand.style.transform = `rotate(${hourAngle}deg)`;
        document.querySelector('.minute-hand').style.transform = `rotate(${minuteAngle}deg)`;
        document.querySelector('.second-hand').style.transform = `rotate(${secondAngle}deg)`;
      };
      setInterval(updateAnalogClock, 1000);
      updateAnalogClock();
    }

    if (clockTime) {
      const updateDigitalClock = () => {
        const now = new Date();
        clockTime.textContent = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}:${String(now.getSeconds()).padStart(2, '0')}`;
        clockDate.textContent = `${now.getFullYear()}年${String(now.getMonth() + 1).padStart(2, '0')}月${String(now.getDate()).padStart(2, '0')}日`;
      };
      setInterval(updateDigitalClock, 1000);
      updateDigitalClock();
    }
  }

  handleAudioControl() {
    const audio = document.getElementById('myAudio');
    const mubtn = document.querySelector('.play-pause-btn');
    if (!audio || !mubtn) return;

    mubtn.addEventListener('click', () => {
      audio.paused ? audio.play() : audio.pause();
      mubtn.classList.toggle('playing');
    });
  }
  debounce(func, wait = 100) {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
    };
  }
  handleBlurEffect() {
    const overlay = document.querySelector('.overlay-blur')
    if (!overlay) return;

    const updateBlur = () => {
      const scrollY = window.scrollY || window.pageYOffset;
      const blurAmount = Math.min((scrollY / window.innerHeight) * 40, 40);

      overlay.style.backdropFilter = `blur(${blurAmount}px) brightness(var(--overlay_brightness))`;
    };

    window.addEventListener('scroll', this.debounce(updateBlur, 100));
  }
  handleScrollButtons() {
    if (!this.elementExists('.upward')) return;
    if (!this.elementExists('.downward')) return;

    const upward = document.querySelector('.upward');
    const downward = document.querySelector('.downward');
    downward.addEventListener('click', () => window.scrollTo({ top: document.documentElement.scrollHeight, behavior: 'smooth' }));
    upward.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    const scrollHandler = () => {
      const currentHeight = window.pageYOffset || document.documentElement.scrollTop;
      upward.style.display = currentHeight > 300 ? 'flex' : 'none';
      const distanceToBottom = document.documentElement.scrollHeight - (currentHeight + window.innerHeight);
      downward.style.display = distanceToBottom > 1000 ? 'flex' : 'none';
    };


    window.addEventListener("scroll", this.debounce(scrollHandler, 100));
  }
  handleHeaderScroll() {
    const header = document.getElementById('header');
    if (!header) return;

    const scrollHandler = () => {
      header.classList.toggle('active', window.scrollY > 100);
    };


    window.addEventListener('scroll', this.debounce(scrollHandler, 100));
  }

  handleFriendForm() {
    if (!this.elementExists('#friendForm')) return;

    const showAlert = (message, type = 'success') => {
      const alert = document.createElement('div');
      alert.className = `alert-message alert-${type}`;
      alert.textContent = message;
      document.body.appendChild(alert);
      setTimeout(() => alert.remove(), 3000);
    };

    const openFriendsForm = document.querySelector('#openFriendsForm')
    openFriendsForm.addEventListener('click', () => {
      const modal = document.getElementById('applicationModal');
      modal.style.display = 'flex';

    })


    const closeFriendsForm = document.querySelector('#closeFriendsForm')
    closeFriendsForm.addEventListener('click', () => {
      const modal = document.getElementById('applicationModal');
      modal.style.display = 'none';

    })




    document.getElementById('friendForm').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = e.target;
      const submitBtn = form.querySelector('.submit-btn');

      submitBtn.disabled = true;
      submitBtn.querySelector('.submit-text').style.opacity = '0';
      submitBtn.querySelector('.loading-dots').style.display = 'block';

      try {
        const response = await fetch('/usr/friends.php', {
          method: 'POST',
          body: new FormData(form)
        });
        const result = await response.json();

        if (result.code === 1) {
          showAlert('申请已提交，请等待审核');
          form.reset();
          const modal = document.getElementById('applicationModal');
          modal.style.display = 'none';
        } else {
          showAlert(result.msg || '提交失败', 'error');
        }
      } catch (error) {
        console.log(error);

      } finally {
        submitBtn.disabled = false;
        submitBtn.querySelector('.submit-text').style.opacity = '1';
        submitBtn.querySelector('.loading-dots').style.display = 'none';
      }
    });
  }

  handleTextEffects() {
    if (this.elementExists('.motto')) {
      setInterval(() => {
        document.querySelector('.motto').style.color =
          `rgb(${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)},${Math.floor(Math.random() * 256)})`;
      }, 2000);
    }

    if (this.elementExists('.dynamics_text')) {
      const printText = async () => {
        const text = await fetch("https://api.kekc.cn/api/yien").then(r => r.json()).then(d => d.cn);
        const element = document.querySelector('.dynamics_text');
        element.textContent = "";

        let index = 0;
        const timer = setInterval(() => {
          if (index < text.length) {
            element.textContent += text[index++];
          } else {
            clearInterval(timer);
            setTimeout(printText, 2000);
          }
        }, 100);
      };
      printText();
    }
  }
  handelSwitchSidebar() {
    if (!this.elementExists('#sidebar')) return;

    const button = document.querySelector('#switch_sidebar')

    const sidebar = document.getElementById('sidebar');
    button.addEventListener('click', () => {
      sidebar.classList.add('active')
    })
  }
  handleSidebarMenu() {
    if (!this.elementExists('#sidebar')) return;

    const sidebar = document.getElementById('sidebar');
    const setActiveMenu = () => {
      const path = window.location.pathname.slice(1) || 'home';
      document.querySelectorAll('.menu-item, .nav-item').forEach(item => {
        item.classList.toggle('active', item.dataset.page === path);
      });
    };

    document.querySelectorAll('.menu-item, .nav-item').forEach(item => {
      item.addEventListener('click', (e) => {
        if (!item.href.startsWith('#')) return;
        e.preventDefault();
        document.querySelectorAll('.menu-item, .nav-item').forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        if (item.closest('.sidebar')) sidebar.classList.remove('active');
      });
    });

    document.addEventListener('click', (e) => {
      if (!sidebar.contains(e.target) && !e.target.closest('#switch_sidebar')) {
        sidebar.classList.remove('active');
      }
    });

    setActiveMenu();
  }

  setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 864e5);
    document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
  }

  getCookie(name) {
    return document.cookie.split('; ')
      .find(row => row.startsWith(`${name}=`))
      ?.split('=')[1];
  }
}

document.addEventListener("DOMContentLoaded", () => new ComponentController());