const burger = document.querySelector('#burger');
const overlay = document.querySelector('.overlay');
const menu = document.querySelector('#menu');
const nav = document.querySelector('#nav');
const headerBtn = document.querySelectorAll('#header-btn');
const popup = document.querySelector('.popup');
const popupSubmit = document.querySelector('#popupSubmit');
const popupReg = document.querySelector('#popupReg');
const calendar = document.querySelector('#calendar-container');
const calendarSubmit = document.querySelector('#submit');

calendarSubmit.addEventListener('click', function () {
    let day = document.querySelector('#active-day');
    let service = document.querySelector('select[name="service"]');
    let time = document.querySelector('select[name="time"]');

    if (!auth) {
        name = document.querySelector('#name').value;
        phone_number = document.querySelector('#phone_number').value;
    }

    if (day !== null) {
        let timestamp = day.getAttribute('data-date');

        fetch(`/request?date=${timestamp}&service_id=${service.value}&time=${time.value}&name=${name}&phone_number=${phone_number}`, {
            method: "GET",
        }).then(data => setNotification(data));
    }
});

const setNotification = function (data) {
    const notificationSuccess = document.querySelector('.success');
    const notificationError = document.querySelector('.error');

    if (data === 'ok') {
        notificationSuccess.style.display = 'block';
    }
    else {
        notificationError.style.display = 'block';
    }
}

const removeNotification = function () {
    const notification = document.querySelector('.success');

    notification.style.display = 'none';
}

headerBtn.forEach(btn => {
    btn.addEventListener('click', function () {
        overlay.classList.add('active');
        popup.style.display = 'block';
    });
});

popupSubmit.addEventListener('click', function () {
    popup.style.display = 'none';
    calendar.classList.add('active');
});

popupReg.addEventListener('click', function () {
     window.location.href = '/register';
});

burger.addEventListener('click', function (event) {
	event.stopPropagation();
	menu.classList.toggle('active');
	burger.classList.toggle('active');
});

overlay.addEventListener('click', function () {
	menu.classList.remove('active');
	burger.classList.remove('active');
    popup.style.display = 'none';
    calendar.classList.remove('active');
    overlay.classList.remove('active');
    removeNotification();
});

// Реализация календаря
const daysContainer = document.querySelector('.days');
const monthDisplay = document.querySelector('.date');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');

const currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();

prevButton.addEventListener('click', () => {
	currentMonth--;
	if (currentMonth < 0) {
		currentMonth = 11;
		currentYear--;
	}
	generateCalendar(currentYear, currentMonth);
});

nextButton.addEventListener('click', () => {
	currentMonth++;
	if (currentMonth > 11) {
		currentMonth = 0;
		currentYear++;
	}
	generateCalendar(currentYear, currentMonth);
});

let rests = null;
let xhr = new XMLHttpRequest();
xhr.open('GET', '/rests', false); // Последний параметр false делает запрос синхронным
xhr.send();
if (xhr.status === 200) {
    rests = JSON.parse(xhr.responseText);
} else {
    console.error('Request failed. Status:', xhr.status);
}

function generateCalendar(year, month) {
	daysContainer.innerHTML = '';

	const daysInMonth = new Date(year, month + 1, 0).getDate();

	monthDisplay.textContent = `${getMonthName(month)} ${year}`;

	const firstDayOfMonth = new Date(year, month, 1).getDay();
	const startDay = (firstDayOfMonth === 0) ? 6 : firstDayOfMonth - 1;
	for (let i = 0; i < startDay; i++) {
		const emptyDayElement = document.createElement('div');
		daysContainer.appendChild(emptyDayElement);
	}

    for (let i = 1; i <= daysInMonth; i++) {
        const dayElement = document.createElement('div');
        dayElement.textContent = i;

        const currentDate = new Date(year, month, i);
        const dayOfWeek = currentDate.getDay();
        if (dayOfWeek === 0 || dayOfWeek === 6) {
            dayElement.classList.add('weekend');
        }

        // Проверяем, есть ли дата текущего дня в массиве rests
        const isRestDay = rests.some(function (el) {
            const restDate = new Date(el.date * 1000); // умножаем на 1000, чтобы получить миллисекунды
            return currentDate.toDateString() === restDate.toDateString();
        });

        // Если это выходной или день отдыха, добавляем соответствующий класс
        if (isRestDay || (dayOfWeek === 0 || dayOfWeek === 6)) {
            dayElement.classList.add('weekend');
        } else {
            dayElement.classList.add('active');
            dayElement.classList.add('day');
            dayElement.setAttribute('data-date', currentDate.toISOString());
        }

        daysContainer.appendChild(dayElement);
    }
}

function getMonthName(month) {
	const months = [
		'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
		'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
	];

	return months[month];
}

generateCalendar(currentYear, currentMonth);

const days = document.querySelector('.days');

days.addEventListener('click', function (event) {
	const dayElement = event.target.closest('.day');
	if (!dayElement) return; // Проверяем, был ли клик на день календаря

	const days = document.querySelectorAll('.day');
	days.forEach(day => {
		day.classList.remove('selected');
        day.removeAttribute('id');
	});

	dayElement.classList.add('selected');
    dayElement.setAttribute('id', 'active-day');
});

document.addEventListener('click', function (event) {
	const timeSlots = document.querySelector('.time-slots');
	if (!timeSlots) return; // Проверяем, отображается ли в данный момент список временных слотов

	if (!timeSlots.contains(event.target)) {
		timeSlots.style.display = 'none'; // Скрываем список временных слотов, если клик был вне его области
	}
});

// Categories and services

const categories = document.querySelectorAll('.category');

categories.forEach(function (category) {
    category.addEventListener('click', function () {
        let category_id = category.getAttribute('data-id');
        window.location.href = `/?id=${category_id}#services`;
    });
});
