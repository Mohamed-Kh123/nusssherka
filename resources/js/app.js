import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

window.Echo.private('orders')
    .listen('.order-created', function(event){
        Swal.fire(
            `New order created ${event.order.number}`
        )
    });

window.Echo.private('payments')
    .listen('.payments-created', function(event){
        Swal.fire(
            `The invoice for this order #${event.payment.order_id} has been successfully paid!`,
        )
    })

window.Echo.private(`Notifications.${userId}`)
    .notification(function(e){
        var count = Number($('#unread').text());
        count++;
        $('.unread').text(count);
        $('#notification').prepend(`
        <a href="#${e.id}" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i>
          <b>*</b>
          ${e.title}
          <span class="float-right text-muted text-sm">${e.time}</span>
        </a>
        `)
    })    

       
