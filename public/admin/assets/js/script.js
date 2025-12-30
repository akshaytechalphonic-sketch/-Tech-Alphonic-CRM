// this code is for show and hide elements and toggle elements like sidebar and mobilemenu and filters
$(document).ready(function () {
  $(".toggle1").click(function () {
    $(this).hide();
    $(".toggle2").show();
    $(".full-logo").hide();
    $(".half-logo").show();
    $(".item-name").hide();
    $(".sidebar").css("width", "85px");
    $(".main-content").css("margin-left", "85px");
    $(".header").css("left", "85px");
    $(".sidebar-menu").addClass("half-menu");
    $(".dropdown-menu-sidebar").hide();
  });
  $(".toggle2").click(function () {
    $(this).hide();
    $(".toggle1").show();
    $(".full-logo").show();
    $(".half-logo").hide();
    setTimeout(function () {
      $(".item-name").show();
    }, 300);
    $(".sidebar").css("width", "264px");
    $(".main-content").css("margin-left", "264px");
    $(".header").css("left", "264px");
    $(".sidebar-menu").removeClass("half-menu");
  });
  $(".menu-item a").click(function(){
    $(".menu-item a").removeClass('active');
    $(this).children(".dropdown-icon").toggleClass('rotate');
    $(this).addClass('active');
  })
  $(".toggle-btn").click(function(){
    $(".sidebar").toggleClass("sidebar-mob-fix");
    $(".mob-menu-layer").show();
  })
  $(".close-mob-menu").click(function(){
    $(".sidebar").toggleClass("sidebar-mob-fix");
    $(".mob-menu-layer").hide();
  })
  $(".menu-dropdown > a").click(function(){
    $(this).siblings(".dropdown-menu-sidebar").slideToggle();
  })
  if (window.matchMedia("(max-width: 767px)").matches){
  $(".search-bar").click(function(){
    $(".search-box-mob").css("display","flex");
  })
  $(".close-search-bar").click(function(){
    $(".search-box-mob").css("display","none");
  })   
}
$(".filter-btn").click(function(){
  $(".filter-popup").toggleShow();
})
$(".reset-filter").click(function(){
  $(".filter-popup").hide();
})
$(".profile").click(function(){
  $(".logout-dropdown").toggle();
})
});


// this code is for tabs to switch grid into table
function openCity(evt, tabs) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabs).style.display = "flex";
  evt.currentTarget.className += " active";
}


// this code is for filter the grid and table according to month in awards page
document.querySelector('.apply-filter-btn').addEventListener('click', function () {
const selectedMonth = document.querySelector('.calander-box input').value; 
const gridParentDivs = document.querySelectorAll('.filter-month'); 
const tableRows = document.querySelectorAll('.filter-month-table'); 

const filterByMonth = (elements, dateSelector, displayStyle) => {
  elements.forEach(element => {
      const dateText = element.querySelector(dateSelector).innerText; 
      const elementDate = new Date(dateText.split('-').reverse().join('-'));
      const elementMonthFormatted = `${elementDate.getFullYear()}-${String(elementDate.getMonth() + 1).padStart(2, '0')}`;

      if (selectedMonth === "" || elementMonthFormatted === selectedMonth) {
          element.style.display = displayStyle; 
      } else {
          element.style.display = 'none';
      }
  });
};
filterByMonth(gridParentDivs, '.buddy-post.month', 'flex');
filterByMonth(tableRows, '.buddy-post.month', 'table-row');
});


// this code for filter in employes page
function applyFilters() {
  const selectedDepartment = document.querySelector(".filter-popup select[name='department']").value.toLowerCase();
  const selectedStatus = document.querySelector(".filter-popup select[name='status']").value.toLowerCase();

  const employeeCards = document.querySelectorAll(".award-single-box");

  employeeCards.forEach((card) => {
    const department = card.querySelector(".buddy-post.month").textContent.toLowerCase();
    const status = card.querySelector(".reason").textContent.toLowerCase();

    if (
      (selectedDepartment === "" || department.includes(selectedDepartment)) &&
      (selectedStatus === "" || status.includes(selectedStatus))
    ) {
      card.parentElement.style.display = "block";
    } else {
      card.parentElement.style.display = "none";
    }
  });

  const tableRows = document.querySelectorAll(".award-table tbody tr");

  tableRows.forEach((row) => {
    const department = row.querySelector(".buddy-post.month").textContent.toLowerCase();
    const status = row.cells[6].textContent.toLowerCase(); 

    if (
      (selectedDepartment === "" || department.includes(selectedDepartment)) &&
      (selectedStatus === "" || status.includes(selectedStatus))
    ) {
      row.style.display = "table-row";
    } else {
      row.style.display = "none";
    }
  });

  document.querySelector(".filter-popup").style.display = "none";
}

function resetFilters() {
  document.querySelector(".filter-popup select[name='department']").value = "";
  document.querySelector(".filter-popup select[name='status']").value = "";

  document.querySelectorAll(".award-single-box").forEach((card) => {
    card.parentElement.style.display = "block";
  });

  document.querySelectorAll(".award-table tbody tr").forEach((row) => {
    row.style.display = "table-row";
  });

  document.querySelector(".filter-popup").style.display = "none";
}

function toggleFilterPopup() {
  const filterPopup = document.querySelector(".filter-popup");
  filterPopup.style.display = filterPopup.style.display === "block" ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", () => {
  document.querySelector(".apply-filter-btn").addEventListener("click", applyFilters);
  document.querySelector(".reset-filter").addEventListener("click", resetFilters);
  document.querySelector(".filter-btn").addEventListener("click", toggleFilterPopup);
});






















