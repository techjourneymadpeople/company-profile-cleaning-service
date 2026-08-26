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

select2();
