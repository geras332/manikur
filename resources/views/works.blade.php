<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,600&display=swap"
          rel="stylesheet">
    <title>NailsbySpufilll - Мои работы</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #D9D9D9;
        }

        .container {
            margin: 0 120px;
        }

        .works {
            width: 100%;
            height: 100vh;
        }

        .works_wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin-top: 130px;
        }

        .works_wrapper h2 {
            text-decoration: underline;
        }

        .image img {
            max-width: 365px;
            max-height: 336px;
            border-radius: 10px;
        }

        .works__images {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, 365px);
            gap: 80px;
            margin: 30px 0;
            justify-content: center;
            align-items: center;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        /* Кнопки для листания изображений */
        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 30px;
            cursor: pointer;
            z-index: 1001;
        }

        .prev {
            left: 25%;
        }

        .next {
            right: 25%;
        }

        /* Скрываем прокрутку страницы при отображении модального окна */
        body.modal-open {
            overflow: hidden;
        }

        @media screen and (max-width: 768px) {
            .container {
                margin: 0 20px;
            }

            .works__images {
                grid-template-columns: repeat(auto-fill, 300px);
                gap: 50px;
            }

            .image img {
                width: 300px;
            }
        }

    </style>
</head>
<body>

<div class="works">
    <div class="container">
        <div class="works_wrapper">
            <h2>Мои работы</h2>
            <div class="works__images">
                @foreach($images as $image)
                    <div class="image">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $(document).ready(function() {
        // Получаем все изображения в блоке .works__images
        const images = $('.works__images .image img');
        const imageCount = images.length;

        // Присваиваем каждому изображению индекс с использованием data-атрибута
        images.each(function(index) {
            $(this).attr('data-index', index);
        });

        // При клике на изображение в блоке .works__images
        images.on('click', function() {
            // Создаем модальное окно
            let modal = $('<div class="modal"></div>');
            let modalImage = $('<img class="modal-image">');
            let closeButton = $('<span class="close">&times;</span>');
            let prevButton = $('<span class="prev">&lt;</span>'); // кнопка "назад"
            let nextButton = $('<span class="next">&gt;</span>'); // кнопка "вперед"

            // Устанавливаем атрибут src для модального изображения и его индекс
            const currentIndex = parseInt($(this).attr('data-index'));
            modalImage.attr('src', $(this).attr('src')).attr('data-index', currentIndex);

            // Добавляем изображение и кнопки в модальное окно
            modal.append(modalImage);
            modal.append(closeButton);
            modal.append(prevButton);
            modal.append(nextButton);

            // Добавляем модальное окно в тело документа
            $('body').append(modal);

            // При клике на кнопку закрытия, удаляем модальное окно
            closeButton.on('click', function() {
                modal.remove();
            });

            // При клике за пределами изображения, также удаляем модальное окно
            $(document).on('click', function(event) {
                if ($(event.target).hasClass('modal')) {
                    modal.remove();
                }
            });

            // При клике на кнопку "назад"
            prevButton.on('click', function() {
                // Получаем текущий индекс изображения
                const currentIndex = parseInt(modalImage.attr('data-index'));
                // Находим предыдущее изображение
                const prevIndex = (currentIndex - 1 + imageCount) % imageCount;
                modalImage.attr('src', images.eq(prevIndex).attr('src')); // Показываем предыдущее изображение
                modalImage.attr('data-index', prevIndex); // Устанавливаем новый индекс текущего изображения
            });

            // При клике на кнопку "вперед"
            nextButton.on('click', function() {
                // Получаем текущий индекс изображения
                const currentIndex = parseInt(modalImage.attr('data-index'));
                // Находим следующее изображение
                const nextIndex = (currentIndex + 1) % imageCount;
                modalImage.attr('src', images.eq(nextIndex).attr('src')); // Показываем следующее изображение
                modalImage.attr('data-index', nextIndex); // Устанавливаем новый индекс текущего изображения
            });
        });
    });

</script>
