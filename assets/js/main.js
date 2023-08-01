$(document).ready(function () {
  // start aos
  AOS.init();

  // slick category
  $(".category__list").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    cssEase: "ease-in-out",
  });

  // comment;
  $(".comment__list").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    cssEase: "ease-in-out",
  });

  // blog;
  $(".blog__list").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    cssEase: "ease-in-out",
  });

  //header
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 130) {
      $(".header").addClass("sticky");
    } else {
      $(".header").removeClass("sticky");
    }
  });

  // detail thumb
  $(".detail__priview-list").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".detail__thumb-list",
    cssEase: "linear",
  });

  $(".detail__thumb-list").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: ".detail__priview-list",
    centerMode: true,
    focusOnSelect: true,
    dots: true,
    // autoplay: true,
    // autoplaySpeed: 2000,
  });

  // Thêm thuộc tính loading="lazy" cho tất cả các thẻ img
  $("img").each(function () {
    $(this).attr("loading", "lazy");
  });

  // Cập nhật số lượng
  $(".price-minus").click(function () {
    var productId = $(this).data("product-id");
    var currentQuantity = parseInt($(this).data("quantity"));
    if (currentQuantity > 1) {
      var newQuantity = currentQuantity - 1;
      updateQuantity(productId, newQuantity);
    }
  });

  $(".price-plus").click(function () {
    var productId = $(this).data("product-id");
    var currentQuantity = parseInt($(this).data("quantity"));
    var newQuantity = currentQuantity + 1;
    updateQuantity(productId, newQuantity);
  });

  function updateQuantity(productId, quantity) {
    $.ajax({
      type: "POST",
      url: "../functions/up_cart.php",
      data: {
        product_id: productId,
        quantity: quantity,
      },
      success: function (data) {
        if (data === "success") {
          // Cập nhật số lượng mới trên giao diện
          $(`[data-product-id="${productId}"] .cart__item-amount`).text(
            quantity
          );
          $(`[data-product-id="${productId}"] .price-minus`).data(
            "quantity",
            quantity
          );
          $(`[data-product-id="${productId}"] .price-plus`).data(
            "quantity",
            quantity
          );

          // Cập nhật tổng tiền
          updateTotalMoney();
        }
      },
    });
  }
  // Cập nhật tổng tiền
  function updateTotalMoney() {
    var totalMoney = 0;
    $(".cart__item").each(function () {
      var price = parseFloat(
        $(this).find(".cart__item-price-new").text().replace(/\D+/g, "")
      );
      var quantity = parseInt($(this).find(".cart__item-amount").text());
      var subtotal = price * quantity;
      totalMoney += subtotal;
    });

    // Cập nhật số tiền với định dạng
    $(".cart__total-price").text(formatMoney(totalMoney) + "đ");
    window.location.reload();
  }

  // Hàm định dạng số tiền
  function formatMoney(amount) {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  // xóa sản phẩm khỏi giỏ hàng

  // Xử lý sự kiện khi người dùng nhấn nút xóa sản phẩm
  $(".cart__item-remove").click(function () {
    var productId = $(this).data("product-id");
    deleteProductFromCart(productId);
  });

  // Hàm gửi yêu cầu xóa sản phẩm bằng Ajax
  function deleteProductFromCart(productId) {
    $.ajax({
      type: "POST",
      url: "../functions/del_cart.php",
      data: {
        product_id: productId,
      },
      success: function (data) {
        if (data === "success") {
          console.log("ok");
          // Xóa sản phẩm khỏi giao diện
          $(`[data-product-id="${productId}"]`).remove();

          // Cập nhật tổng tiền
          updateTotalMoney();
        }
      },
      error: function (xhr, status, error) {
        console.log("Error:", error);
      },
    });
  }
});
