document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-pills a');
    const courseCards = document.querySelectorAll('.course-card');

    navLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Ngăn chặn hành động mặc định

            // Cập nhật trạng thái active cho các liên kết
            navLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active');

            const selectedCategory = link.textContent; // Lấy tên danh mục từ liên kết

            // Lọc các khóa học
            courseCards.forEach(card => {
                const category = card.querySelector('.category').textContent; // Lấy danh mục của khóa học
                if (selectedCategory === 'View All' || category === selectedCategory) {
                    card.style.display = 'block'; // Hiển thị khóa học nếu khớp với danh mục
                } else {
                    card.style.display = 'none'; // Ẩn khóa học nếu không khớp
                }
            });
        });
    });
});
