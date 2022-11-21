import { reactive } from "vue";
import Swal from "sweetalert2";

export let modal = reactive({

    // actions
    confirm(title, text, confirmedCallback) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Avbryt',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                confirmedCallback();
            }
          })
    },

    message() {
        alert('message');
    },

    error() {
        alert('error');
    },
});
