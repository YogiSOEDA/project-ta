const btnClear = document.getElementById('close');
const btnEditClear = document.getElementById('close-edit');
const form = document.querySelector('form');
const formEdit = document.getElementById('form-edit-barang');
const imgPreview = document.querySelector('.img-preview');

btnClear.addEventListener('click', () => {
    imgPreview.style.display = 'none';
    form.reset();
})

btnEditClear.addEventListener('click', () => {
    formEdit.reset();
})

