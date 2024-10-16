const swiper = new Swiper('.swiper-container', {
    loop: true, // Cho phép lặp lại slider
    slidesPerView: 3, // Hiển thị 3 slide cùng một lúc
    spaceBetween: 20, // Khoảng cách giữa các slide
    pagination: {
        el: '.swiper-pagination', // Phân trang
        clickable: true, // Cho phép người dùng nhấp vào nút phân trang
    },
    autoplay: {
        delay: 5000, // Thời gian tự động chuyển đổi giữa các slide
        disableOnInteraction: false, // Không tắt autoplay khi người dùng tương tác
    },
    speed: 1500, // Thời gian trượt giữa các slide (ms)
});
