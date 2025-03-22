<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paging với Slick Carousel</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .carousel {
      width: 80%;
      margin: 0 auto;
    }

    .carousel div {
      background-color: #ddd;
      padding: 50px;
      text-align: center;
      font-size: 20px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
    }

    .pagination button {
      padding: 10px 15px;
      margin: 0 5px;
      /* Khoảng cách giữa các nút */
      border: 1px solid #ccc;
      background-color: #fff;
      color: #333;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
    }

    .pagination button:hover {
      background-color: #4CAF50;
      color: white;
    }

    .pagination button.active {
      background-color: rgb(4, 141, 204);
      cursor: not-allowed;
      color: #ccc;
    }

    .pagination span {
      font-size: 16px;
      margin: 0 10px;
    }
  </style>
</head>

<body>

  <div class="carousel">
    <div>Slide 1</div>
    <div>Slide 2</div>
    <div>Slide 3</div>
    <div>Slide 4</div>
    <div>Slide 5</div>
    <div>Slide 6</div>
    <div>Slide 7</div>
    <div>Slide 8</div>
    <div>Slide 9</div>
    <div>Slide 10</div>
    <div>Slide 11</div>
    <div>Slide 12</div>
    <div>Slide 13</div>
    <div>Slide 14</div>
    <div>Slide 15</div>
    <div>Slide 16</div>
    <div>Slide 17</div>
    <div>Slide 18</div>
    <div>Slide 19</div>
    <div>Slide 20</div>
    <div>Slide 21</div>
    <div>Slide 22</div>
    <div>Slide 23</div>
  </div>

  <div class="pagination">
    <button id="prev-first" class="disabled"><<</button>
    <button id="prev" class="disabled"><</button>
    <span id="page-numbers"></span>
    <button id="next" class="disabled">></button>
    <button id="next-last" class="disabled">>></button>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script>
    $(document).ready(function() {
      const $carousel = $('.carousel');
      const totalSlides = $carousel.children().length;
      const slidesPerPage = 1; // Hiển thị 1 slide mỗi lần
      const slidesPerMove = 1; // Di chuyển 1 trang mỗi lần
      const totalPages = Math.ceil(totalSlides / slidesPerPage);

      let currentPage = 1;

      $carousel.slick({
        slidesToShow: slidesPerPage,
        slidesToScroll: slidesPerPage,
        infinite: false,
        dots: false,
        arrows: false
      });

      // Cập nhật phân trang
      function updatePagination() {
        $('#page-numbers').html('');

        // Tính toán các số trang cần hiển thị
        let startPage = Math.max(1, currentPage - Math.floor(3 / 2)); // Tính trang đầu
        let endPage = Math.min(totalPages, startPage + 2); // Tính trang cuối

        // if (endPage - startPage < 4) {
        //   startPage = Math.max(1, endPage - 4); // Điều chỉnh khi số trang không đủ
        // }

        // Hiển thị các nút trang
        for (let i = startPage; i <= endPage; i++) {
          const pageButton = $('<button>')
            .text(i)
            .attr('data-page', i)
            .on('click', function() {
              currentPage = i;
              updatePagination(); // Cập nhật lại phân trang
              $carousel.slick('slickGoTo', (i - 1) * slidesPerPage); // Di chuyển carousel tới trang được chọn
            })
            .toggleClass('active', i === currentPage);

          $('#page-numbers').append(pageButton);
        }

        // Cập nhật trạng thái các nút "prev" và "next"
        $('#prev-first').toggleClass('disable', currentPage === 1);
        $('#prev').toggleClass('disable', currentPage === 1);
        $('#next').toggleClass('disable', currentPage === totalPages);
        $('#next-last').toggleClass('disable', currentPage === totalPages);
      }

      // Các sự kiện cho các nút phân trang
      $('#prev-first').on('click', function() {
        if (!$(this).hasClass('active')) {
          currentPage = 1;
          updatePagination(); // Chỉ cập nhật phân trang mà không thay đổi slide
          $carousel.slick('slickGoTo', 0); // Di chuyển carousel đến slide đầu tiên
        }
      });

      $('#prev').on('click', function() {
        if (!$(this).hasClass('active')) {
          currentPage = Math.max(1, currentPage - slidesPerMove); // Lùi 4 trang
          updatePagination(); // Chỉ cập nhật phân trang mà không thay đổi slide
          $carousel.slick('slickGoTo', (currentPage - 1) * slidesPerPage); // Di chuyển carousel đến slide tương ứng
        }
      });

      $('#next').on('click', function() {
        if (!$(this).hasClass('active')) {
          currentPage = Math.min(totalPages, currentPage + slidesPerMove); // Tiến 4 trang
          updatePagination(); // Chỉ cập nhật phân trang mà không thay đổi slide
          $carousel.slick('slickGoTo', (currentPage - 1) * slidesPerPage); // Di chuyển carousel đến slide tương ứng
        }
      });

      $('#next-last').on('click', function() {
        if (!$(this).hasClass('active')) {
          currentPage = totalPages;
          updatePagination(); // Chỉ cập nhật phân trang mà không thay đổi slide
          $carousel.slick('slickGoTo', (totalPages - 1) * slidesPerPage); // Di chuyển carousel đến slide cuối cùng
        }
      });

      updatePagination();
    });
  </script>
</body>

</html>