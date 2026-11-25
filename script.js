// Đợi cho cấu trúc HTML load xong mới chạy JavaScript
document.addEventListener("DOMContentLoaded", function() {

    // 1. XỬ LÝ XÁC NHẬN KHI XÓA SẢN PHẨM (TRANG ADMIN)
    // Tìm tất cả các nút có class là 'btn-delete'
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            // Hiển thị hộp thoại xác nhận
            let isConfirm = confirm("Bạn có chắc chắn muốn xóa sản phẩm này không? Dữ liệu sẽ bị xóa vĩnh viễn khỏi Database!");
            
            // Nếu người dùng bấm "Cancel" (Hủy), thì chặn lệnh chuyển sang trang xoa.php
            if (!isConfirm) {
                event.preventDefault(); 
            }
        });
    });

    // 2. XỬ LÝ KIỂM TRA FORM LIÊN HỆ (CLIENT-SIDE VALIDATION)
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            const phoneInput = document.querySelector('input[name="phone"]');
            
            // Nếu có nhập số điện thoại, kiểm tra xem có đúng định dạng số không (ví dụ 10 số)
            if (phoneInput.value !== "") {
                const phoneRegex = /^[0-9]{10}$/; // Biểu thức chính quy: Bắt buộc là 10 chữ số
                if (!phoneRegex.test(phoneInput.value)) {
                    alert("Lỗi: Số điện thoại không hợp lệ. Vui lòng nhập đúng 10 chữ số!");
                    event.preventDefault(); // Chặn không cho gửi form đi
                }
            }
        });
    }

});

// 3. HÀM XỬ LÝ NÚT "THÊM VÀO GIỎ HÀNG" (TRANG CHI TIẾT SẢN PHẨM)
function addToCart() {
    alert("Tính năng Giỏ hàng đang được nâng cấp. Vui lòng liên hệ Hotline: 0123 456 789 để đặt mua!");
}