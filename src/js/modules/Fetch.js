'use strict';

import {popupHandler} from '/src/js/modules/Handler';

function newFetch(url, cb = () => {}) {
    // init.method = init.method ? init.method : 'POST';
    const init = {};
    init.method = 'POST';
    fetch(url, init)
        .then(response => {
            const ContentTypeHeader = response.headers.get('Content-Type');
            switch (ContentTypeHeader) {
                case 'text/plain':
                case 'text/plain;charset=UTF-8':
                case 'text/plain; charset=UTF-8':
                case 'text/html':
                case 'text/html;charset=UTF-8':
                case 'text/html; charset=UTF-8':
                    return response.text();
                case 'application/json':
                    return response.json();

                default:
                    return response.text();
            }
        })
        .then(response => {
            cb(response);
            const $response = document.querySelector('section.response');
            const $responseP = $response.querySelector('p');
            // Вариант1
            $responseP.innerHTML =
                response.success ? response.success.message
                    : response.error ? response.error.message
                        : response.message ? response.message : '';
            $responseP.innerHTML && popupHandler($response);
            // Вариант 2
            // if (response.message) {
            //     $responseP.innerHTML = response.message;
            //     popupHandler($response);
            // }
            // Вариант 3
            // $responseP.innerHTML = response.message;
            // $responseP.innerHTML && popupHandler($response);
            // Вариант 4
            // if (response.message) {
            //     const $response = document.querySelector('section.response');
            //     const $responseP = $response.querySelector('p');
            //     $responseP.innerHTML = response.message;
            //     $responseP.innerHTML && popupHandler($response);
            // }

            if(response.content)  {
                document.getElementById('main').innerHTML = response.content;
                document.querySelector('title').textContent = response.title;
                document.querySelector('meta[name=description]').content = response.description;
            }
            response.reload && window.location.reload();
        })
        .catch(error => console.error(error));
}

function fetchFormOld($form, cb = () => {}) {
    const fetchInit = {
        method: $form.method,
        body  : new FormData($form)
    };
    newFetch($form.action, fetchInit, response => {
        cb(response);
        if (response.success) {
            const $popup = $form.closest('.popup');
            $popup && $popup.classList.add('dn');
        }
    });
}
function fetchForm($form) {
    const fetchInit = {
        method: $form.method,
        body  : new FormData($form)
    };
    newFetch($form.action, fetchInit, response => {
        if (response.success) {
            const $popup = $form.closest('.popup');
            $popup && $popup.classList.add('dn');
        }
    });
}


export {newFetch, fetchForm};
