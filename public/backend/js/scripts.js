/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
//
// Scripts
//

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    const tablelist = document.querySelector('#datatable');
    const deleteForm = document.querySelector('.delete-form');
    if (tablelist) {
        tablelist.addEventListener("click", (e) => {
            if (e.target.classList.contains("delete-action")) {
                e.preventDefault();
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Không thể khôi phục!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đồng ý xóa !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const action = e.target.href;
                        deleteForm.action = action;
                        deleteForm.submit();
                    }
                });
            }
        });
    }

    function getSlug(title) {
        // Đổi chữ hoa thành chữ thường
        let slug = title.toLowerCase();

        // Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
        slug = slug.replace(/đ/gi, "d");

        // Xóa các ký tự đặc biệt
        slug = slug.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );

        // Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");

        // Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        slug = slug.replace(/-+/g, "-");

        // Xóa các ký tự gạch ngang ở đầu và cuối
        slug = slug.replace(/^-+|-+$/g, "");

        return slug;
    }

    const title = document.querySelector('.title')
    const slug = document.querySelector('.slug')

    title.addEventListener('keyup', event => {
        const titlelValue = event.target.value;
        if (titlelValue === "") {
            slug.value = getSlug(titlelValue)
        }

    })


    slug.addEventListener('change', event => {
        const slug = document.querySelector('.slug')
        if (slug.value === "") {
            slug.value = getSlug(title.value)
        }
    })


});



