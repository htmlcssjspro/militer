'use strict';

import {newFetch, fetchUrl, fetchForm, mainLoad, mainReload, reload} from '/src/js/modules/Fetch';


function inputCheck($input) {

    let error = '';

    const spaceRegexp = /^\s+$/;
    const emailRegexp = /^[A-Za-z0-9]+[\w.-]*[A-Za-z0-9]+@[\w-]+\.[a-z]{2,5}$/is;
    const passwordRegexp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&?]).{8,}$/s;

    const lengthCheck = () => {
        if ($input.dataset.required === 'required' && $input.value.trim().length < 2) {
            error = 'Поле обязательно к заполнению и должно содержать минимум <strong>2</strong> символа';
            return true;
        }
    };
    const emailCheck = () => {
        if ($input.type === 'email' && !emailRegexp.test($input.value)) {
            error = 'Введите корректный Email';
            return true;
        }
    };
    const passwordCheck = () => {
        if (
            $input.value.trim().length
            && (($input.type === 'password' || $input.type === 'text')
                && ($input.name === 'new-password' || $input.name === 'confirm-new-password'))
            && !passwordRegexp.test($input.value)
        ) {
            error = 'Пароль должен содержать не менее <strong>8</strong> символов: буквы латинского алфавита в обоих регистрах, цифры, специальные символы <strong>! @ # $ % & ?</strong>';
            return true;
        }
    };
    const confirmPasswordCheck = () => {
        if ($input.name === 'confirm-new-password') {
            const confirm = $input.value;
            const password = $input.closest('form').querySelector('input[name=new-password]').value;
            if (confirm === password) {
                return false;
            } else {
                error = 'Пароли не совпадают';
                return true;
            }
        }
    };

    $input.dataset.validation = (lengthCheck() || emailCheck() || confirmPasswordCheck() || passwordCheck()) ? 'invalid' : 'valid';

    let $error;
    const $next = $input.closest('label').nextElementSibling;
    if ($next && $next.classList.contains('error_input')) {
        $error = $next;
    } else {
        $error = document.createElement('span');
        $error.className = 'error_input';
        $input.closest('label').after($error);
    }
    $error.innerHTML = error;
}

function inputHandler(event) {
    const t = event.target;
    if (t.tagName === 'INPUT') {
        inputCheck(t);
    }
}

function validation($form) {
    const inputs = $form.querySelectorAll('input:not([type=hidden])');
    return Array.from(inputs).every($input => {
        inputCheck($input);
        return $input.dataset.validation === 'valid';
    });
}

const formsHandler = event => {
    event.preventDefault();
    // const t = event.target;
    const $form = event.target.closest('form');
    validation($form) && fetchForm($form);
};
function formHandler() {
    document.body.addEventListener('focusin', inputHandler, false);
    document.body.addEventListener('input',   inputHandler, false);
    document.body.addEventListener('change',  inputHandler, false);

    document.body.addEventListener('submit', formsHandler, false);
}


function clickHandler(data) {
    document.body.addEventListener('click', event => {
        event.preventDefault();
        const t = event.target;
        if (t.tagName === 'BUTTON' && t.type === 'button') {
            const popup = t.dataset.popup;
            popup && popupHandler(popup);
            const href = t.dataset.href;
            href && fetchUrl(href);
            const cb = t.dataset.cb;
            cb && data && setTimeout(() => data[cb](t), 100);
        }
        if (t.tagName === 'A') {
            const href = t.getAttribute('href');
            console.log('href: ', href);
            href && mainLoad(href);
        }
    });
}


function popupHandler(popup) {
    const $popup = typeof popup === 'string' ? document.querySelector(popup) : popup;
    // const $popup = document.querySelector(popupSelector);
    if ($popup) {
        const handler = event => {
            if (event.currentTarget === event.target) {
                $popup.classList.add('dn');
                $popup.removeEventListener('click', handler, false);
            }
        };
        $popup.addEventListener('click', handler, false);
        $popup.classList.remove('dn');
    }
}

function dropdownHandlerOld(dropdownSelector) {
    const dropdownList = document.querySelectorAll(dropdownSelector);
    dropdownList && dropdownList.forEach($dropdown => {
        const $span = $dropdown.querySelector('span');
        const $dropdownContent = $span.nextElementSibling;
        $span && $span.addEventListener('click', () => {
            $dropdownContent && $dropdownContent.classList.toggle('dn');
        });
    });
}
function dropdownHandler() {
    const dropdownList = document.body.querySelectorAll('.dropdown');
    dropdownList && dropdownList.forEach($dropdown => {
        const $toggle = $dropdown.querySelector('.dropdown__toggle');
        const $content = $dropdown.querySelector('.dropdown__content');
        $toggle && $toggle.addEventListener('click', () => {
            $content && $content.classList.toggle('dn');
        });
    });
}



export {formHandler, clickHandler, popupHandler, dropdownHandler};
