import './bootstrap';
import Swal from 'sweetalert2';

Echo.channel('questions')
    .listen('NewQuestion', (e) => {
        addRow(e);
    });

try {
    window.$ = require('jquery');

    require('jszip');
    require('datatables.net-bs5')();
    require('datatables.net-buttons-bs5')();
    require('datatables.net-buttons/js/buttons.html5.js')();
} catch (e) {}

let table = $('#questions-table').DataTable({
    responsive: true,
    buttons: [
        'excel'
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
    },
    order: [2, 'desc']
});

function addRow(data) {
    console.log(data);
    table.row.add({
        0: data.name,
        1: data.question,
        2: {
            "display": data.date,
            "@data-order": data.date_order
        },
        3: "",
    }).draw();
    showQuestion(data);
}

function showQuestion(data) {
    Swal.fire({
        title: data.question,
        text: data.name,
        icon: 'question',
        confirmButtonText: 'Listo'
    });
}