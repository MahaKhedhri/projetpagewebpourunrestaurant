//This part highlights the current section in the navigation menu as the user scrolls
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll("nav ul li a");

  window.addEventListener("scroll", () => {
    let currentSection = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;
      if (window.scrollY >= sectionTop - sectionHeight / 3) {
        currentSection = section.getAttribute("id");
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href").includes(currentSection)) {
        link.classList.add("active");
      }
    });
  });
});





//This section allows clicking on menu links to switch images dynamically.
document.addEventListener("DOMContentLoaded", () => {
  const menuLinks = document.querySelectorAll(".menu-list a");
  menuLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const targetId = link.getAttribute("href").substring(1);
      const targetImage = document.getElementById(targetId);
      document.querySelectorAll(".image-container .image").forEach((image) => {
        image.style.display = "none";
      });
      if (targetImage) {
        targetImage.style.display = "block";
      }
    });
  });
});





//This section dynamically updates the menu list and images based on the selected category 
document.addEventListener("DOMContentLoaded", () => {
  const menuButtons = document.querySelectorAll(".menu-buttons button");
  const menuList = document.getElementById("menu-list");
  const imageContainer = document.getElementById("image-container");


  const menus = {
    salad: [
      { name: "Rosa d'inverno", price: "$12.00", image: "../images/rosa.jpg" },
      { name: "Foie gras", price: "$10.00", image: "../images/foiegras.avif" },
      { name: "Mare", price: "$10.00", image: "../images/Mare.avif" },
      { name: "Tartare classica", price: "$10.00", image: "../images/tart.jpg" },
      { name: "Burrata with Roasted Peppers", price: "$10.00", image: "../images/burrata.jpg" },
    ],
    pasta: [
      { name: "Cacio e pepi", price: "$14.00", image: "../images/pexels-nadin-sh-78971847-20644784.jpg" },
      { name: "Pasta All'Uovo", price: "$13.00", image: "../images/tagliolini.jpg" },
      { name: "L’ANATRA", price: "$13.00", image: "../images/tortelli.jpg" },
      { name: "TAGLIOLINO", price: "$13.00", image: "../images/TAGLIOLINO.jpg" },
      { name: "Pollo ,Pollo ,Pollo", price: "$13.00", image: "../images/Tortellini.jpg" },
    ],
    "main-course": [
      { name: "Fritto misto de mare", price: "$20.00", image: "../images/frito.jpg" },
      { name: "IL “CIOPPINO”", price: "$25.00", image: "../images/cioppino.jpg" },
      { name: "Daily Fish", price: "$13.00", image: "../images/poisson.jpg" },
      { name: "Guancetta Di Vitello", price: "$13.00", image: "../images/cheek.jpg" },
      { name: "CHATEAUBRIAND", price: "$13.00", image: "../images/Beef.jpg" },
    ],
    desserts: [
      { name: "Il Formaggio", price: "$21", image: "../images/formaggio.jpg" },
      { name: "IL CUORE CALDO ", price: "$17", image: "../images/cuore.jpg" },
      { name: "Coppa “AL PONTILE”", price: "$17", image: "../images/coppa.jpg" },
      { name: "NOCCIOLA E CIOCCOLATO", price: "$18", image: "../images/nocciola.jpg" },
      { name: "Sorbets of your choic", price: "$15", image: "../images/sorbets.jpg" },
    ],
    specials: [
      { name: "LA MISTA", price: "$16", image: "../images/mista.jpg" },
      { name: "La Bruschetta Valtellinse ", price: "$25", image: "../images/brus.jpg" },
      { name: "Tartare Do Filetto Di Manzo", price: "$51", image: "../images/tartare.jpg" },
      { name: "Soupe du jour", price: "$16", image: "../images/Soupe.jpg" },
      { name: "CREPES SUZETTE ", price: "$13", image: "../images/crepe.jpg" },
    ],
  };
  const maxItems = Math.max(
    ...Object.values(menus).map((menu) => menu.length)
  ); 
  const updateMenu = (menuKey) => {
    const items = menus[menuKey];
    menuList.innerHTML = ""; 
    imageContainer.innerHTML = "";

    items.forEach((item, index) => {
      const listItem = document.createElement("li");
      listItem.innerHTML = `<a href="#" class="menu-item">${item.name}</a> <span class="price">${item.price}</span>`;
      menuList.appendChild(listItem);
      listItem.querySelector(".menu-item").addEventListener("click", (event) => {
        event.preventDefault(); 
        displayImage(item.image);
      });
      if (index === 0) {
        displayImage(item.image);
      }
    });
    const placeholdersNeeded = maxItems - items.length;
    for (let i = 0; i < placeholdersNeeded; i++) {
      const placeholder = document.createElement("li");
      placeholder.classList.add("placeholder");
      placeholder.innerHTML = `<span class="menu-item">-</span> <span class="price">-</span>`;
      menuList.appendChild(placeholder);
    }
  };

  const displayImage = (imageUrl) => {
    imageContainer.innerHTML = ""; 
    const imageDiv = document.createElement("div");
    imageDiv.classList.add("image");
    imageDiv.style.backgroundImage = `url(${imageUrl})`;
    imageContainer.appendChild(imageDiv);
  };

  menuButtons.forEach((button) => {
    button.addEventListener("click", () => {
      menuButtons.forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");
      const menuKey = button.getAttribute("data-menu");
      updateMenu(menuKey);
    });
  });
  updateMenu("salad");
});





//This effect creates a smooth floating movement when moving the mouse
document.addEventListener("mousemove", (event) => {
  const parallaxItems = document.querySelectorAll("[data-parallax-item]");
  parallaxItems.forEach((item) => {
    const speed = item.getAttribute("data-parallax-speed");
    const x = (window.innerWidth - event.pageX * speed) / 100;
    const y = (window.innerHeight - event.pageY * speed) / 100;
    item.style.transform = `translateX(${x}px) translateY(${y}px)`;
  });
});





//This function allows scrolling through an image gallery left or right
function scrollGallery(direction) {
  const gallery = document.querySelector('.gallery');
  const scrollAmount = 300; // Number of pixels to scroll

  if (direction === 'left') {
    gallery.scrollBy({
      left: -scrollAmount,
      behavior: 'smooth'
    });
  } else if (direction === 'right') {
    gallery.scrollBy({
      left: scrollAmount,
      behavior: 'smooth'
    });
  }
}