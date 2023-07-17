const btnClear = document.getElementById('close');
const form = document.querySelector('form');
const imgPreview = document.querySelector('.img-preview');

btnClear.addEventListener('click', () => {
    imgPreview.style.display = 'none';
    form.reset();
})

