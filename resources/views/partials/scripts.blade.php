<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>

<script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const commentsContainer = document.querySelector(".comments");

        // Lấy token từ session
        const token = '{{ session('token') }}';

        // Kiểm tra sự tồn tại của biến $podcast
        const podcastId = '{{ isset($podcast) ? $podcast->id : '' }}';

        // Xóa comment
        commentsContainer.addEventListener("click", (event) => {
            if (event.target.classList.contains("delete-btn")) {
                const comment = event.target.closest(".comment");
                const commentId = comment.dataset.id;

                fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        commentsContainer.removeChild(comment);
                    } else {
                        alert('Failed to delete comment.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });

        // Sửa comment
        commentsContainer.addEventListener("click", (event) => {
            if (event.target.classList.contains("edit-btn")) {
                const comment = event.target.closest(".comment");
                const contentElement = comment.querySelector(".comment-content");
                const commentId = comment.dataset.id;

                // Tạo textarea thay cho nội dung cũ
                const textarea = document.createElement("textarea");
                textarea.value = contentElement.textContent; // Lấy nội dung hiện tại
                textarea.className = "edit-textarea";

                contentElement.replaceWith(textarea); // Thay thế <p> bằng <textarea>

                // Chuyển nút "Edit" thành "Save"
                const editBtn = event.target;
                editBtn.textContent = "Save";
                editBtn.classList.add("save-btn");
                editBtn.classList.remove("edit-btn");

                // Xử lý khi nhấn "Save"
                editBtn.addEventListener(
                    "click",
                    function saveComment() {
                        // Gửi request AJAX để cập nhật comment
                        fetch(`/comments/${commentId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`,
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                content: textarea.value,
                                podcast_id: podcastId,
                                podcaster_id: '{{ session('podcaster_id') }}'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 1) {
                                // Reload trang sau khi cập nhật thành công
                                location.reload();
                            } else {
                                alert('Failed to update comment.');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    },
                    { once: true } // Đảm bảo chỉ chạy sự kiện một lần
                );
            }
        });
    });
</script>