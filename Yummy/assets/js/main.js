/**
* Template Name: Yummy
* Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
* Updated: Aug 07 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function () {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  mobileNavToggleBtn.addEventListener('click', mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function (swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function (e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();

const cartBtn = document.getElementById("cart-btn");
const cartModal = document.getElementById("cart-modal");
const closeCart = document.getElementById("close-cart");
const cartTableBody = document.querySelector("#cart-table tbody");
const cartTotal = document.getElementById("cart-total");
const checkoutBtn = document.getElementById("checkout-btn");
const cartCount = document.getElementById("cart-count");

let cart = JSON.parse(localStorage.getItem("cart")) || {};
let isCartVisible = false;

function updateCartStorage() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

let cartq = 0;
document.querySelectorAll('[data-name][data-price]').forEach(button => {
  button.addEventListener('click', function () {
    cartq++;
    const countElement = document.getElementById('cart-count');
    countElement.textContent = cartq;

    // 加上動畫 class
    countElement.classList.add('cart-slide');
    countElement.addEventListener('animationend', () => {
      countElement.classList.remove('cart-slide');
    }, { once: true });


    // 動畫播放完移除 class
    countElement.addEventListener('animationend', () => {
      countElement.classList.remove('cart-bounce');
    }, { once: true });

    // 這裡也可以把商品資訊存入 localStorage
  });
});

function renderCart() {
  cartTableBody.innerHTML = "";
  let total = 0;
  const items = Object.values(cart);

  if (items.length === 0) {
    cartTableBody.innerHTML = `
      <tr>
        <td colspan="5"><div class="cart-empty-message">購物車目前是空的</div></td>
      </tr>`;
    checkoutBtn.style.display = 'none'; // 隱藏按鈕

  } else {
    checkoutBtn.style.display = 'block'; // 顯示按鈕

    items.forEach(item => {
      const subtotal = item.price * item.qty;
      total += subtotal;
      const row = document.createElement("tr");
      row.innerHTML = `
        <td data-label="品項">${item.name}</td>
        <td data-label="單價">$${item.price.toFixed(2)}</td>
        <td data-label="數量">
          <button class="btn qty-btn" data-action="decrease" data-name="${item.name}">-</button>
          <span class="mx-1">${item.qty}</span>
          <button class="btn qty-btn" data-action="increase" data-name="${item.name}">+</button>
        </td>
        <td data-label="小計">$${subtotal.toFixed(2)}</td>
        <td><button class="btn btn-sm btn-danger" data-action="remove" data-name="${item.name}">刪除</button></td>
      `;
      cartTableBody.appendChild(row);
    });
  }

  cartTotal.textContent = `$${total.toFixed(2)}`;
  cartCount.textContent = items.reduce((sum, item) => sum + item.qty, 0);
  updateCartStorage();
}

function toggleCartModal() {
  isCartVisible = !isCartVisible;
  if (isCartVisible) {
    cartModal.classList.add("show");
    renderCart();
  } else {
    cartModal.classList.remove("show");
  }
}

cartBtn.addEventListener("click", toggleCartModal);
closeCart.addEventListener("click", () => {
  isCartVisible = false;
  cartModal.classList.remove("show");
});

document.body.addEventListener("click", (e) => {
  const name = e.target.dataset.name;
  if (e.target.dataset.action === "increase") {
    cart[name].qty++;
  } else if (e.target.dataset.action === "decrease") {
    cart[name].qty = Math.max(1, cart[name].qty - 1);
  } else if (e.target.dataset.action === "remove") {
    delete cart[name];
  }
  renderCart();
});

document.querySelectorAll("button[data-name]").forEach(btn => {
  btn.addEventListener("click", () => {
    const name = btn.dataset.name;
    const price = parseFloat(btn.dataset.price);
    if (cart[name]) {
      cart[name].qty++;
    } else {
      cart[name] = { name, price, qty: 1 };
    }
    renderCart();
  });
});

checkoutBtn.addEventListener("click", () => {
  alert("結帳成功！");
  cart = {};
  renderCart();
  cartModal.classList.remove("show");
  isCartVisible = false;
});

renderCart();

function updateCheckoutButton() {
  const items = JSON.parse(localStorage.getItem('cartItems')) || [];
  const checkoutBtn = document.getElementById('checkout-btn');

  checkoutBtn.style.display = items.length === 0 ? 'none' : 'block';
}

// 初始執行一次
updateCheckoutButton();

