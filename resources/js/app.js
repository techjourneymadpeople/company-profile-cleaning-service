import './bootstrap';
import $ from 'jquery';
import Swal from 'sweetalert2';
import flatpickr from 'flatpickr';
import select2 from 'select2';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import DataTable from 'datatables.net-dt';

window.$ = window.jQuery = $;
window.Swal = Swal;
window.flatpickr = flatpickr;
window.ClassicEditor = ClassicEditor;
window.DataTable = DataTable;

window.togglePasswordVisibility = function(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    
    const eyeIcon = btn.querySelector('.eye-icon');
    const eyeSlashIcon = btn.querySelector('.eye-slash-icon');
    if (eyeIcon && eyeSlashIcon) {
        eyeIcon.classList.toggle('hidden', isPassword);
        eyeSlashIcon.classList.toggle('hidden', !isPassword);
    }
    btn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
};

select2();
