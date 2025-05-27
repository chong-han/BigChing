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

// 取得 DOM 元素
const cartBtn = document.getElementById("cart-btn");
const cartModal = document.getElementById("cart-modal");
const closeCart = document.getElementById("close-cart");
const cartTableBody = document.querySelector("#cart-table tbody");
const cartTotal = document.getElementById("cart-total");
const checkoutBtn = document.getElementById("checkout-btn");
const cartCount = document.getElementById("cart-count");

// 從 localStorage 讀取購物車資料，若無則初始化空物件
let cart = JSON.parse(localStorage.getItem("cart")) || {};
let isCartVisible = false;

// 更新 localStorage
function updateCartStorage() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

// 顯示成功提示動畫
function showSuccessToast() {
  const toastEl = document.getElementById('successToast');

  toastEl.classList.remove('show'); // 先移除
  void toastEl.offsetWidth; // 觸發 reflow，強制讓動畫重啟
  toastEl.classList.add('show');

  setTimeout(() => toastEl.classList.remove('show'), 3000);
}

// 更新購物車數量動畫
function animateCartCount() {
  cartCount.classList.add('cart-slide');
  cartCount.addEventListener('animationend', () => {
    cartCount.classList.remove('cart-slide');
  }, { once: true });
}

// 將購物車內容渲染到畫面
function renderCart() {
  cartTableBody.innerHTML = "";
  let total = 0;
  const items = Object.values(cart);

  if (items.length === 0) {
    cartTableBody.innerHTML = `
      <th colspan="5" class="cart-empty-th">
        <div class="cart-empty-message">購物車目前是空的</div>
      </th>
    `;
    checkoutBtn.style.display = 'none';
  } else {
    checkoutBtn.style.display = 'block';
    items.forEach(item => {
      const subtotal = item.price * item.qty;
      total += subtotal;
      const row = document.createElement("tr");
      row.innerHTML = `
        <td data-label="品項">${item.name}</td>
        <td data-label="單價">$${item.price}</td>
        <td data-label="數量">
          <button class="btn qty-btn" data-action="decrease" data-name="${item.name}">-</button>
          <span class="mx-1">${item.qty}</span>
          <button class="btn qty-btn" data-action="increase" data-name="${item.name}">+</button>
        </td>
        <td data-label="小計">$${subtotal}</td>
        <td><button class="btn btn-sm btn-danger" data-action="remove" data-name="${item.name}">刪除</button></td>
      `;
      cartTableBody.appendChild(row);
    });
  }

  cartTotal.textContent = `$${total}`;
  cartCount.textContent = items.reduce((sum, item) => sum + item.qty, 0);
  updateCartStorage();
}

// 切換購物車視窗顯示
function toggleCartModal() {
  isCartVisible = !isCartVisible;
  if (isCartVisible) {
    cartModal.classList.add("show");
    renderCart();  // 你原本的渲染購物車函式
  } else {
    cartModal.classList.remove("show");
  }
}

// 點擊購物車按鈕，切換購物車視窗並阻止事件冒泡（避免點擊 document 觸發關閉）
cartBtn.addEventListener("click", (e) => {
  e.stopPropagation();
  toggleCartModal();
});

// 點擊購物車關閉按鈕，直接關閉購物車
closeCart.addEventListener("click", () => {
  isCartVisible = false;
  cartModal.classList.remove("show");
});

// 點擊購物車視窗本體時阻止事件冒泡（避免點擊視窗內部也關閉）
cartModal.addEventListener("click", (e) => {
  e.stopPropagation();
});

// 點擊頁面其他區域時關閉購物車視窗
document.addEventListener("click", () => {
  if (isCartVisible) {
    isCartVisible = false;
    cartModal.classList.remove("show");
  }
});

// 商品按鈕：加入購物車
document.querySelectorAll('[data-name][data-price]').forEach(button => {
  button.addEventListener('click', () => {
    const name = button.dataset.name;
    const price = parseFloat(button.dataset.price);

    if (cart[name]) {
      cart[name].qty++;
    } else {
      cart[name] = { name, price, qty: 1 };
    }
    cartCount.textContent = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
    animateCartCount();
    renderCart();
    showSuccessToast();
  });
});

// 監聽購物車內的加減及刪除按鈕（事件代理）
cartTableBody.addEventListener("click", (e) => {
  const action = e.target.dataset.action;
  const name = e.target.dataset.name;
  if (!action || !name) return;

  if (action === "increase") {
    cart[name].qty++;
  } else if (action === "decrease") {
    cart[name].qty = Math.max(1, cart[name].qty - 1);
  } else if (action === "remove") {
    delete cart[name];
  }
  renderCart();
});

// 購物車結帳按鈕
checkoutBtn.addEventListener("click", (e) => {
  e.preventDefault(); // 阻止表單的預設提交行為

  const form = document.getElementById('checkoutForm'); // 取得表單元素
  form.innerHTML = ''; // 清除現有的隱藏 input（如果有的話），確保每次提交都是最新的資料

  // 添加一個隱藏 input 欄位用於總金額
  const totalInput = document.createElement('input'); //
  totalInput.type = 'hidden'; //
  totalInput.name = 'cart_total'; //
  totalInput.value = parseFloat(cartTotal.textContent.replace('$', '')); //
  form.appendChild(totalInput); //

  // 為購物車中的每個品項添加隱藏 input 欄位
  Object.values(cart).forEach((item, index) => { //
    // 品項名稱
    const nameInput = document.createElement('input'); //
    nameInput.type = 'hidden'; //
    nameInput.name = `item_name[${index}]`; //
    nameInput.value = item.name; //
    form.appendChild(nameInput); //

    // 品項單價
    const priceInput = document.createElement('input'); //
    priceInput.type = 'hidden'; //
    priceInput.name = `item_price[${index}]`; //
    priceInput.value = item.price; //
    form.appendChild(priceInput); //

    // 品項數量
    const qtyInput = document.createElement('input'); //
    qtyInput.type = 'hidden'; //
    qtyInput.name = `item_qty[${index}]`; //
    qtyInput.value = item.qty; //
    form.appendChild(qtyInput); //

    // 品項小計
    const subtotalInput = document.createElement('input'); //
    subtotalInput.type = 'hidden'; //
    subtotalInput.name = `item_subtotal[${index}]`; //
    subtotalInput.value = (item.price * item.qty); //
    form.appendChild(subtotalInput); //
  });

  form.submit(); // 程式化地提交表單

  // alert("前往結帳結帳！"); 
  cart = {}; // 清空購物車
  renderCart(); // 重新渲染購物車以顯示為空
  cartModal.classList.remove("show"); // 隱藏購物車模態視窗
  isCartVisible = false; // 更新購物車可見狀態
});

// 初始化渲染購物車
renderCart();


