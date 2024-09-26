import './bootstrap';
import '../scss/app.scss';
import * as bootstrap from 'bootstrap';
import jQuery from 'jquery'; $ = window.$ = window.jQuery = jQuery;

import.meta.glob([
    '../favicon/**',
    '../images/**',
    '../fonts/**',
]);

const DOCUMENT = $(document);

DOCUMENT.ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    DOCUMENT.on('click', '[data-add-to-cart]', addToCart);
    DOCUMENT.on('click', '[data-delete]', deleteFromCart);
    DOCUMENT.on('click', '[data-add]', addOrRemove);
    DOCUMENT.on('click', '[data-remove]', addOrRemove);

    function addToCart() {
        let id = $(this).data('product-id') || 0;
        let qnt = $(this).data('qnt') || 0;

        $.ajax({
            type: 'POST',
            url: '/basket/add/' + id,
            data: {qnt: qnt},
            success: function (response) {
                $('#response').html(JSON.stringify(response, null, 4));
            },
            error: function (xhr) {
                $('#response').html(xhr);
            }
        });
    }

    function deleteFromCart()
    {
        let id = $(this).data('delete') || 0;
        let sessionId = $(this).data('session') || '';

        $.ajax({
            type: 'POST',
            url: '/basket/delete/' + id,
            data: {sessionId: sessionId},
            success: function (response) {
                $('#response').html(JSON.stringify(response, null, 4));
            },
            error: function (xhr) {
                $('#response').html(xhr);
            }
        });
    }

    function addOrRemove() {
        let session = $(this).data('session') || '';
        let remove = $(this).data('remove') || 0;
        let add = $(this).data('add') || 0;

        let action = 'plus'
        if (remove > 0) {
            action = 'minus'
        }

        let id = remove || add;

        $.ajax({
            type: 'POST',
            url: '/basket/count/' + id + '/' + action,
            data: {session: session},
            success: function (response) {
                $('#response').html(JSON.stringify(response, null, 4));
                $('[data-product-id-count="' + id + '"]').html(response.data.quantity);
            },
            error: function (xhr) {
                $('#response').html(xhr);
            }
        });
    }
});
