'use strict';

import newFetch, {mainLoad, mainReload, reload} from '/src/js/modules/Fetch';
import popupHandler from '/src/js/modules/popupHandler';

export default function formHandler(formSection, cb = r => r) {

    const $response = document.querySelector('.response');
    const $responseP = $response.querySelector('p');
    const $formSection = typeof formSection === 'string' ? document.querySelector(formSection) : formSection;
    if ($formSection) {
        const $form = $formSection.querySelector('form');
        const inputs = () => $form.querySelectorAll('span[data-required="required"] > input');

        const validation = () => Array.from(inputs()).every($input => $input.dataset.validation === 'valid');
        const inputCheck = $input => {
            const $error = $input.closest('label').nextElementSibling;
            const emailRegexp = /^[A-Za-z0-9]+[\w.-]*[A-Za-z0-9]+@[\w-]+\.[a-z]{2,5}$/is;
            const passwordRegexp = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@$%&?]).{8,}$/s;
            $input.dataset.validation = ($input.value.length < 2 ||
                $input.type === 'email' && !emailRegexp.test($input.value) ||
                $input.name === 'password' && !passwordRegexp.test($input.value)
            ) ? 'invalid' : 'valid';
            $error.style.visibility = $input.dataset.validation === 'valid' ? 'hidden' : 'visible';
        };

        const inputHandler = event => {
            const $input = event.currentTarget;
            if ($input.type === 'password' && (event.type === 'copy' || event.type === 'cut')) {
                event.preventDefault();
            }
            inputCheck($input);
        };

        inputs().forEach($input => {
            $input.addEventListener('input', inputHandler, false);
            $input.addEventListener('change', inputHandler, false);
            inputCheck($input);
        });

        const inputsRemoveEventListener = () => {
            inputs().forEach($input => {
                $input.removeEventListener('input', inputHandler, false);
                $input.removeEventListener('change', inputHandler, false);
            });
        };

        const handler = event => {
            event.preventDefault();
            if (validation()) {
                const url = $form.action;
                const fetchInit = {};
                fetchInit.method = $form.method;
                fetchInit.body = new FormData($form);
                newFetch(url, fetchInit, response => {
                    if (response.success) {
                        $responseP.innerHTML = response.success.message;
                        const $popup = $form.closest('.popup');
                        if($popup){
                            $popup.classList.add('dn');
                            inputsRemoveEventListener();
                            $form.removeEventListener('submit', handler, false);
                        }
                    } else if (response.error) {
                        $responseP.innerHTML = response.error.message;
                    } else {
                        $responseP.textContent = 'Неожиданный ответ сервера';
                    }
                    popupHandler($response);
                    cb(response);
                    response.mainReload && mainReload();
                    response.reload && reload();
                });
            }
        };
        $form.addEventListener('submit', handler, false);
    }
}
