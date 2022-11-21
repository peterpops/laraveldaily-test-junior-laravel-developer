import { reactive } from "vue";
import Swal from "sweetalert2";

export let toast = reactive({

    // actions
    success(title, text='', timerInMilliSeconds=2000, showConfirmButton=false, position="top-end") {
        Swal.fire({
            toast: true,
            position: position,
            width: '300px',
            icon: 'success',
            title: title,
            text: text,
            showConfirmButton: showConfirmButton,
            timer: timerInMilliSeconds,
          });
    },

    info(title, text='', timerInMilliSeconds=2000, showConfirmButton=false, position="top-end") {
        Swal.fire({
            toast: true,
            position: position,
            width: '300px',
            icon: 'info',
            title: title,
            text: text,
            showConfirmButton: showConfirmButton,
            timer: timerInMilliSeconds,
          });
    },

    error(title, text='', timerInMilliSeconds=2000, showConfirmButton=false, position="top-end") {
        Swal.fire({
            toast: true,
            position: position,
            width: '300px',
            icon: 'error',
            title: title,
            text: text,
            showConfirmButton: showConfirmButton,
            timer: timerInMilliSeconds,
          });
    },
});
