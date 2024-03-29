<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adaptive.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,700;1,600&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <title>NailsbySpufilll</title>
</head>
<body>

<nav class="nav" id="nav">
    <div class="container">
        <div class="nav__wrapper">
            <div class="logo">
                <a href="#"><img src="{{ asset('images/logo.png') }}" alt="Лого"></a>
                <span class="nav__logo">NailsbySpufilll</span>
            </div>
            <div class="menu-btn" id="burger">
                <div class="menu-btn__burger"></div>
            </div>
            <ul class="menu" id="menu">
                @if(!auth()->check())
                    <li class="menu__item">
                        <a href="#about" class="menu__item-link">Обо мне</a>
                    </li>
                @endif
                <li class="menu__item">
                    <a href="#price" class="menu__item-link">Прайс</a>
                </li>
                @if(!auth()->check())
                    <li class="menu__item">
                        <a href="#works" class="menu__item-link">Мои работы</a>
                    </li>
                    <li class="menu__item">
                        <a href="#advantage" class="menu__item-link">Преимущества</a>
                    </li>
                    <li class="menu__item">
                        <a href="#exp" class="menu__item-link">С чем работаю</a>
                    </li>
                @endif
                @if(auth()->check())
                    <li class="menu__item">
                        <a href="#notes" class="menu__item-link">Мои записи</a>
                    </li>
                @endif
                <li class="menu__item">
                    <a href="#contacts" class="menu__item-link">Контакты</a>
                </li>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <li class="menu__item">
                        <a href="{{ route('admin.index') }}" class="menu__item-link">Админка</a>
                    </li>
                @endif
                @if(auth()->check())
                    <li class="menu__item">
                        <a href="#" onclick="logout()" class="menu__item-link">Выйти</a>
                    </li>
                    <form action="{{ route('logout') }}" method="post" id="logout" style="display: none;">
                        @csrf
                    </form>
                    <li class="menu__item">
                        <a href="#" class="menu__item-link">{{ auth()->user()->name }}</a>
                    </li>
                @else
                    <li class="menu__item">
                        <a href="{{ route('login') }}" class="menu__item-link">Войти</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if(!auth()->check() || (auth()->check() && auth()->user()->hasRole('admin')))
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <div class="header-content">
                    <h1 class="header-text">
                        Домашняя <br> студия маникюра <br> <span class="logo"
                                                                 style="font-family: 'Courgette', cursive;">NailsbySpufilll</span>
                    </h1>
                    <button type="button" class="header-content__btn" id="header-btn">Записаться</button>
                </div>
                <div class="header-images">
                    <img src="{{ asset('images/header_img1.png') }}" alt="">
                    <img src="{{ asset('images/header_img2.png') }}" alt="">
                </div>
            </div>
        </div>
    </header>

    <div class="about">
        <div class="container">
            <div class="about__content">
                <div class="about__content-img">
                    <img src="{{ asset('images/about_img.png') }}" alt="">
                </div>
                <div class="about__content-description" id="about">
                    <h2 class="about__content-description__title">Обо мне</h2>
                    <p class="about__content-description__text">Привет. Меня зовут Ксения. Я мастер маникюра из города
                        Москва со стажем работы 4 года. Выполняю дизайны на заказ или во время процесса вместе с Вами
                        создадим уникальный и красивый дизайн. Я работаю в домашней студии, где вы будете себя
                        чувствовать
                        как дома. Во время работы можете выпить чай или кофе, угоститься сладостями, посмотреть фильм,
                        послушать музыку и просто провести время в уюте и комфорте.</p>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="services">
    <div class="container">
        <div class="services__content">
            <h2 class="services__content-title" id="services">Услуги</h2>
            <div class="services__category">
                @foreach($categories as $category)
                    <button
                        class="category {{ request('id') == $category->id || ($loop->first && !request('id')) ? 'active' : '' }}"
                        data-id="{{ $category->id }}">{{ $category->title }}</button>
                @endforeach
            </div>
        </div>
        <div class="services__list-wrapper" id="price">
            <div class="services__list">
                @foreach($services as $service)
                    <div class="service">
                        <h2 class="service__title">{{ $service->title }}</h2>
                        <span class="service__price">{{ $service->price }} руб</span>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="button" class="header-content__btn" id="header-btn">Записаться</button>
    </div>
</div>

@if(auth()->check())
    @if($userNotes->count() > 0)
        <div class="notes" id="notes">
            <div class="container">
                <h2 class="notes__title">Мои записи</h2>
                <div class="notes__list">
                    @foreach($userNotes as $note)
                        <p>{{ date('Y-m-d', $note->date) }} - {{ $note->service->title }}</p>
                    @endforeach
                </div>
                <button type="button" class="header-content__btn" id="header-btn">Записаться</button>
            </div>
        </div>
    @endif
@endif

@if(!auth()->check() || (auth()->check() && auth()->user()->hasRole('admin')))
    <div class="works">
        <div class="container">
            <div class="works_wrapper">
                <h2 class="works_title" id="works">
                    Мои работы
                </h2>
                <div class="works__images">
                    @foreach($images as $image)
                        <div class="work-image">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}" alt="">
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('images') }}" class="read-more">Больше работ</a>
            </div>
        </div>
    </div>

    <div class="advantages">
        <div class="container">
            <div class="advantages__wrapper">
                <div class="advantages__wrapper-content">
                    <div class="advantage__title">
                        <h2 class="advantages-title" id="advantage">
                            Почему Вам стоит записаться ко мне?
                        </h2>
                    </div>
                    <div class="advantages__images">
                        <div class="advantage-img">
                            <img src="{{ asset('images/advantage1.jpg') }}" alt="">
                            <h2 class="advantage-text">Стойкость</h2>
                        </div>
                        <div class="advantage-img">
                            <img src="{{ asset('images/advantage2.jpg') }}" alt="">
                            <h2 class="advantage-text">Хорошие отзывы</h2>
                        </div>
                        <div class="advantage-img">
                            <img src="{{ asset('images/advantage3.jpg') }}" alt="">
                            <h2 class="advantage-text">Дипломированный мастер</h2>
                        </div>
                        <div class="advantage-img">
                            <img src="{{ asset('images/advantage4.jpg') }}" alt="">
                            <h2 class="advantage-text">Стерильные материалы</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="exp">
        <div class="container">
            <div class="exp__wrapper">
                <div class="exp__wrapper-content">
                    <h2 class="exp-title" id="exp">
                        С чем работаю?
                    </h2>
                    <div class="exp__images">
                        <div class="exp-img first">
                            <img src="{{ asset('images/exp_1.png') }}" alt="">
                            <p class="exp-desc">Лак для стемпинга “Picnail”</p>
                        </div>
                        <div class="exp-img">
                            <img src="{{ asset('images/exp_2.png') }}" alt="">
                            <p class="exp-desc">Стойкие гели для укрепления и комуфлирования</p>
                        </div>
                        <div class="exp-img">
                            <img src="{{ asset('images/exp_3.png') }}" alt="">
                            <p class="exp-desc">Фрезер strong 210</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="contacts">
                <div class="contacts-title" id="contacts">
                    Контакты
                </div>
                <div class="social">
                    <img src="{{ asset('images/telegram.png') }}" alt="">
                    <a href="https://t.me/nails_by_spifullll" target="_blank">Telegram</a>
                </div>
                <div class="social">
                    <img src="{{ asset('images/instagram.png') }}" alt="">
                    <a href="https://instagram.com/nails_by_spifulll?igshid=MzRlODBiNWFlZA=="
                       target="_blank">Instagram</a>
                </div>
                <div class="social">
                    <img src="{{ asset('images/tel.png') }}" alt="">
                    <a href="tel:89099949765">89099949765</a>
                </div>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2252.5327250988394!2d37.719006077175706!3d55.627546001631515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x414ab3e74db6bfe5%3A0x4ad217789645bf42!2z0JHQvtGA0LjRgdC-0LLRgdC60LjQuSDQv9GALdC0LCAxMSwg0JzQvtGB0LrQstCwLCDQoNC-0YHRgdC40Y8sIDExNTU2Mw!5e0!3m2!1sru!2skg!4v1709033523190!5m2!1sru!2skg"
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</footer>

<div class="calendar-container" id="calendar-container">
    <div class="calendar__wrapper">
        <div class="calendar">
            <div class="month">
                <button class="prev">&#10094;</button>
                <div class="date">Февраль 2024</div>
                <button class="next">&#10095;</button>
            </div>
            <div class="weekdays">
                <div>Пн</div>
                <div>Вт</div>
                <div>Ср</div>
                <div>Чт</div>
                <div>Пт</div>
                <div>Сб</div>
                <div>Вс</div>
            </div>
            <div class="days"></div>
        </div>
        <div class="sidebar">
            <div role="alert" class="success" style="width: fit-content">
                Заявка оставлена
            </div>
            <div role="alert" class="error" style="width: fit-content">
                Выберите другую дату
            </div>
            <h2 style="font-weight: 500;width: fit-content">Услуга</h2>
            <select name="service" style="outline: auto;margin-top: 10px;max-width: 200px">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                @endforeach
            </select>

            <h2 style="font-weight: 500;margin-top: 20px;width: fit-content">Время</h2>
            <select name="time" style="outline: auto;margin-top: 10px;">
                <option value="10:00 - 13:00">10:00 - 13:00</option>
                <option value="14:00 - 17:00">14:00 - 17:00</option>
                <option value="18:00 - 21:00">18:00 - 21:00</option>
            </select>
            @if(!auth()->check())
                <h2 style="font-weight: 500;margin-top: 20px;width: fit-content">Ваше имя</h2>
                <input type="text" name="name" id="name" placeholder="Имя"
                       style="background-color: #BCBCBC;padding: 10px;border-radius: 5px;margin-top: 5px;">
                <h2 style="font-weight: 500;margin-top: 20px;width: fit-content">Ваш номер телефона</h2>
                <input type="text" name="phone_number" id="phone_number" placeholder="Номер телефона"
                       style="background-color: #BCBCBC;padding: 10px;border-radius: 5px;margin-top: 5px;">
            @endif
            <div style="width: fit-content">
                <button type="button" id="submit" class="submit">Записаться</button>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>
<div class="popup">
    <div class="popup__container">
        <div>
            <h2>Для отслеживания своих записей можете</h2>
            <button type="button" id="popupReg">Зарегистрироваться</button>
        </div>
        <div>
            <h2>или просто</h2>
            <button type="button" id="popupSubmit">ЗАПИСАТЬСЯ</button>
        </div>
    </div>
</div>

<script>
    const auth = {{ auth()->check() ? 1 : 0 }};

    let name = '{{ auth()->check() ? auth()->user()->name : null }}';
    let phone_number = '{{ auth()->check() ? auth()->user()->phone_number : null }}';

    function logout() {
        document.getElementById('logout').submit();
    }
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
